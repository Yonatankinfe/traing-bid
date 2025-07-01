<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    // BaseController can have an initController method to check admin auth for all methods in this controller.
    // For now, assume admin is authenticated.

    public function dashboard()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'pending_providers_count' => 5, // Simulated
            'total_users_count' => 150, // Simulated
            'active_chats_count' => 25, // Simulated
        ];
        return view('admin/dashboard', $data);
    }

    public function providersList()
    {
        // Simulated list of providers awaiting approval
        $providers = [
            ['id' => 1, 'name' => 'Trainer John Doe', 'submitted_on' => '2024-07-30', 'status' => 'Pending KYC Fee', 'kyc_paid' => false],
            ['id' => 2, 'name' => 'Yoga Guru Jane Smith', 'submitted_on' => '2024-07-31', 'status' => 'Pending Photo Review', 'kyc_paid' => true],
            ['id' => 3, 'name' => 'Coach Mike Ross', 'submitted_on' => '2024-08-01', 'status' => 'Approved', 'kyc_paid' => true],
            ['id' => 4, 'name' => 'Physio Alice Brown', 'submitted_on' => '2024-08-01', 'status' => 'Rejected', 'kyc_paid' => true, 'rejection_reason' => 'ID photo unclear'],
        ];
        $data = [
            'title' => 'Manage Provider Approvals',
            'providers' => $providers,
            'filter_status' => $this->request->getGet('status') ?? 'all' // Example filter
        ];
        return view('admin/providers_list', $data);
    }

    public function viewProviderDetails($providerId = null)
    {
        if (!$providerId) {
            return redirect()->to('admin/providers')->with('error', 'Provider ID missing.');
        }
        // Simulated provider details
        $provider = [
            'id' => $providerId,
            'name' => 'Yoga Guru Jane Smith', // Fetched based on ID
            'gender' => 'Female',
            'skills' => ['Yoga', 'Meditation', 'Senior Fitness'],
            'base_monthly_price' => '₹12,000 - ₹15,000',
            'available_time_slots' => ['Morning', 'Evening'],
            'area_pincode' => 'Koramangala / 560034',
            'can_train' => ['Women', 'Seniors', 'All'],
            'phone_number' => '98XXXXXX02 (Hidden from users)',
            'submitted_on' => '2024-07-31',
            'status' => 'Pending Photo Review',
            'kyc_paid' => true,
            'kyc_payment_id' => 'pay_N8fhsdf89sHF',
            'photos' => [
                'front_face' => 'https://via.placeholder.com/300x200.png?text=Front+Face+KYC',
                'side_face' => 'https://via.placeholder.com/300x200.png?text=Side+Face+KYC',
                'id_holding' => 'https://via.placeholder.com/300x200.png?text=ID+Holding+KYC',
            ],
            'admin_notes' => 'Initial review looks good. ID details are clear.'
        ];
        $data = [
            'title' => 'Provider Details: ' . $provider['name'],
            'provider' => $provider
        ];
        return view('admin/provider_details', $data);
    }

    // Placeholder actions for provider approval
    public function approveProvider($providerId) { /* ... */ return redirect()->to('admin/providers')->with('message', "Provider ID {$providerId} approved (simulated)."); }
    public function rejectProvider($providerId) { /* ... */ return redirect()->to('admin/providers')->with('message', "Provider ID {$providerId} rejected (simulated)."); }


    public function chatsList()
    {
        // Simulated list of chats
        $chats = [
            ['id' => 101, 'client_name' => 'Sunil Varma', 'provider_name' => 'Trainer Priya Sharma', 'last_message_on' => '2024-08-01 10:00', 'messages_count' => 15, 'request_id' => 301],
            ['id' => 102, 'client_name' => 'Anita Desai', 'provider_name' => 'Coach Anand Kumar', 'last_message_on' => '2024-07-31 15:30', 'messages_count' => 5, 'request_id' => 302],
        ];
        $data = [
            'title' => 'Audit Chats',
            'chats' => $chats
        ];
        return view('admin/chats_list', $data);
    }

    public function viewSpecificChat($chatId = null)
    {
        if (!$chatId) {
            return redirect()->to('admin/chats')->with('error', 'Chat ID missing.');
        }
        // Simulated chat details (similar to ChatController's index method but for admin)
        $chat_partner_client = ['name' => 'Sunil Varma', 'role' => 'Client'];
        $chat_partner_provider = ['name' => 'Trainer Priya Sharma', 'role' => 'Provider'];
        $messages = [ /* ... simulated messages ... */ ];

        $data = [
            'title' => 'View Chat: ' . $chat_partner_client['name'] . ' & ' . $chat_partner_provider['name'],
            'client' => $chat_partner_client,
            'provider' => $chat_partner_provider,
            'messages' => $messages, // Reuse message structure from ChatController if possible
            'chat_id' => $chatId
        ];
        return view('admin/chat_view', $data); // This view would be similar to the user chat view but read-only for admin
    }

    public function usersList()
    {
        // Simulated list of users
        $users = [
            ['id' => 'u001', 'name' => 'Client Sunil', 'role' => 'Client', 'joined_on' => '2024-07-20', 'status' => 'Active', 'is_blocked' => false],
            ['id' => 'p001', 'name' => 'Trainer Priya', 'role' => 'Provider', 'joined_on' => '2024-07-22', 'status' => 'Active', 'is_blocked' => false, 'is_verified' => true],
            ['id' => 'u002', 'name' => 'Client Anita', 'role' => 'Client', 'joined_on' => '2024-07-25', 'status' => 'Blocked', 'is_blocked' => true],
        ];
        $data = [
            'title' => 'Manage Users',
            'users' => $users
        ];
        return view('admin/users_list', $data);
    }

    // Placeholder actions for user management
    public function blockUser($userId) { /* ... */ return redirect()->to('admin/users')->with('message', "User ID {$userId} blocked (simulated)."); }
    public function unblockUser($userId) { /* ... */ return redirect()->to('admin/users')->with('message', "User ID {$userId} unblocked (simulated)."); }
    public function removeUser($userId) { /* ... */ return redirect()->to('admin/users')->with('message', "User ID {$userId} removed (simulated)."); }

}
