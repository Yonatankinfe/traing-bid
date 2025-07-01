<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        // In a real app, if user is already logged in, redirect them
        // if (session()->get('isLoggedIn')) {
        //    return redirect()->to('/');
        // }
        return view('auth/login');
    }

    // Placeholder for handling OTP request
    public function requestOtp()
    {
        // This will handle mobile number submission and trigger OTP generation
        // For now, it might just redirect back or show a message
        // $mobile = $this->request->getPost('mobile');
        // Validate mobile number
        // Call OTP service
        // Store OTP (e.g., in session or temp db record)
        // Redirect back to login page with a message or to an OTP entry page
        return redirect()->to('login')->with('message', 'OTP functionality will be implemented here.');
    }

    // Placeholder for handling OTP verification
    public function verifyOtp()
    {
        // This will handle OTP submission and verification
        // $otp = $this->request->getPost('otp');
        // $mobile = session()->get('otp_mobile'); // Or however mobile is persisted
        // Validate OTP
        // If valid, log the user in (set session) and redirect to role selection or dashboard
        // If invalid, redirect back with error
        return redirect()->to('login')->with('error', 'OTP verification will be implemented here.');
    }

    public function selectRole()
    {
        // In a real app, ensure user is logged in but hasn't selected a role yet
        // if (!session()->get('isLoggedIn') || session()->get('role')) {
        //    return redirect()->to('/');
        // }
        return view('auth/select_role');
    }

    // Placeholder for handling role submission
    public function processRoleSelection()
    {
        // $role = $this->request->getPost('role');
        // Validate role
        // Save role to user's profile (database)
        // Update session with the role
        // Redirect to the respective onboarding form (Client or Provider)
        // For now:
        // $selectedRole = $this->request->getPost('role');
        // if ($selectedRole === 'client') {
        //     return redirect()->to('client/onboarding')->with('message', 'Role selected: Client. Please complete onboarding.');
        // } elseif ($selectedRole === 'provider') {
        //     return redirect()->to('provider/onboarding')->with('message', 'Role selected: Provider. Please complete onboarding.');
        // }
        return redirect()->to('role-selection')->with('message', 'Role processing will be implemented here.');
    }
}
