<x-admin-layout :title="'Manage Users - Admin Panel'">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Manage Users</h5>
                <button class="btn btn-success btn-sm float-end" id="addUserBtn">Add User</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td>{{ $user->formatted_balance }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm view-transactions" data-id="{{ $user->id }}">
                                        Transactions
                                    </button>
                                    <button class="btn btn-warning btn-sm edit-user" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                        data-role="{{ $user->roles->pluck('name')->first() }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add/Edit User Modal --}}
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="userForm">
                        @csrf
                        <input type="hidden" name="_method" id="_method" value="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <small>(Leave empty to keep current
                                        password)</small></label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Transaction History Modal --}}
        <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transactionModalLabel">Transaction History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="transactionTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="transactionTableBody">
                                <!-- Transaction data will be dynamically loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userModal = new bootstrap.Modal(document.getElementById('userModal'));
            const transactionModal = new bootstrap.Modal(document.getElementById('transactionModal'));

            /**
             * Handle Add/Edit User Form Submission
             */
            document.getElementById('userForm').addEventListener('submit', async (event) => {
                event.preventDefault();

                const formData = new FormData(event.target);
                const method = document.getElementById('_method').value;
                const userId = event.target.dataset.id || '';
                const url = method === 'POST' ?
                    '/admin/users' :
                    `/admin/users/${userId}`;

                try {
                    const response = await fetch(url, {
                        method,
                        body: formData,
                    });

                    if (!response.ok) {
                        const errorResult = await response.json();
                        Swal.fire(errorResult.title || 'Error', errorResult.text ||
                            'Something went wrong.', 'error');
                        return;
                    }

                    const result = await response.json();
                    Swal.fire(result.title || 'Success', result.text ||
                            'Operation completed successfully.', result.icon || 'success')
                        .then(() => {
                            window.location.reload();
                        });
                } catch (error) {
                    console.error('Unexpected Error:', error);
                    Swal.fire('Error', 'An unexpected error occurred. Please try again later.',
                    'error');
                }
            });

            /**
             * Open Add User Modal
             */
            document.getElementById('addUserBtn').addEventListener('click', () => {
                document.getElementById('userModalLabel').textContent = 'Add User';
                document.getElementById('userForm').reset();
                document.getElementById('_method').value = 'POST';
                delete document.getElementById('userForm').dataset.id; // Remove the user ID for new users
                userModal.show();
            });

            /**
             * Open Edit User Modal
             */
            document.querySelectorAll('.edit-user').forEach(button => {
                button.addEventListener('click', (event) => {
                    const {
                        id,
                        name,
                        email,
                        role
                    } = event.target.dataset;

                    document.getElementById('name').value = name;
                    document.getElementById('email').value = email;
                    document.getElementById('role').value = role;
                    document.getElementById('password').value = ''; // Clear password field
                    document.getElementById('_method').value = 'PUT';
                    document.getElementById('userForm').dataset.id = id;
                    document.getElementById('userModalLabel').textContent = 'Edit User';
                    userModal.show();
                });
            });

            /**
             * Open Transaction History Modal
             */
            document.querySelectorAll('.view-transactions').forEach(button => {
                button.addEventListener('click', async (event) => {
                    const userId = event.target.dataset.id;
                    const tableBody = document.getElementById('transactionTableBody');
                    tableBody.innerHTML =
                        '<tr><td colspan="4" class="text-center">Loading...</td></tr>'; // Loading state

                    try {
                        const response = await fetch(`/admin/users/${userId}/transactions`);
                        if (!response.ok) {
                            Swal.fire('Error',
                                'Unable to load transactions. Please try again later.',
                                'error');
                            return;
                        }

                        const transactions = await response.json();
                        tableBody.innerHTML = ''; // Clear loading state

                        if (transactions.length === 0) {
                            tableBody.innerHTML =
                                '<tr><td colspan="4" class="text-center">No transactions found.</td></tr>';
                        } else {
                            transactions.forEach(transaction => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${transaction.date}</td>
                                    <td>${transaction.type}</td>
                                    <td>Rp${new Intl.NumberFormat('id-ID').format(transaction.amount)}</td>
                                    <td>${transaction.status}</td>
                                `;
                                tableBody.appendChild(row);
                            });
                        }

                        transactionModal.show();
                    } catch (error) {
                        console.error('Unexpected Error:', error);
                        Swal.fire('Error',
                            'Unable to load transactions. Please try again later.', 'error');
                    }
                });
            });
        });
    </script>

</x-admin-layout>
