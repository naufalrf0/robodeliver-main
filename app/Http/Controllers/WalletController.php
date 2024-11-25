<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\WalletTransaction;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    /**
     * Generate a QR code for top-up using an external API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateQrCode(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        try {
            $user   = Auth::user();
            $amount = $request->input('amount');

            // Create a new transaction with status 'pending'
            $transaction = WalletTransaction::create([
                'user_wallet_id'     => $user->wallet->id,
                'transaction_type'   => 'top_up',
                'amount'             => $amount,
                'transaction_status' => 'pending',
                'reference'          => Str::random(16),
            ]);

            // Generate the data for the QR code
            $qrData = route('topup.process', ['reference' => $transaction->reference]);

            // Return the QR data and transaction ID in the response
            return response()->json([
                'status'        => 'success',
                'qrData'        => $qrData,
                'transactionId' => $transaction->id,
            ]);
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Error generating QR data: ' . $e->getMessage());

            // Return an error response
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to generate QR data. Please try again later.',
            ], 500);
        }
    }

    /**
     * Process the top-up after the QR code is scanned.
     *
     * @param  string  $reference
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processTopup($reference)
    {
        try {
            Log::info('Processing top-up for reference: ' . $reference);

            // Retrieve the pending transaction using the reference
            $transaction = WalletTransaction::where('reference', $reference)
                ->where('transaction_status', 'pending')
                ->firstOrFail();

            // Deposit the amount into the user's wallet
            $transaction->wallet->deposit($transaction->amount);

            // Update the transaction status to 'success'
            $transaction->update(['transaction_status' => 'success']);

            // Flash success message to session
            return redirect()->route('dashboard')->with('sweetAlert', [
                'status' => 'success',
                'message' => 'Top-up successful!',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Transaction not found or already processed for reference: ' . $reference);

            // Flash error message to session
            return redirect()->route('dashboard')->with('sweetAlert', [
                'status' => 'error',
                'message' => 'Invalid or already processed transaction.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error processing top-up: ' . $e->getMessage());

            // Flash error message to session
            return redirect()->route('dashboard')->with('sweetAlert', [
                'status' => 'error',
                'message' => 'Failed to process top-up. Please try again.',
            ]);
        }
    }

    public function generatePaymentQr(Request $request, $reference)
{
    try {
        $transaction = WalletTransaction::where('reference', $reference)
            ->where('transaction_status', 'pending')
            ->firstOrFail();

        $qrData = route('payment.process', ['reference' => $transaction->reference]);

        return response()->json([
            'status' => 'success',
            'qrData' => $qrData,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal menghasilkan QR Code. Silakan coba lagi.',
        ], 500);
    }
}
}
