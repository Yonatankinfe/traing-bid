<?php

namespace App\Controllers;

class ProviderController extends BaseController
{
    public function onboarding()
    {
        // Ensure user is logged in, role is provider, and onboarding not complete
        // if (!session()->get('isLoggedIn') || session()->get('role') !== 'provider' || session()->get('provider_onboarding_complete')) {
        //    return redirect()->to('/');
        // }

        $data = [
            'genders' => ['Male', 'Female', 'Other'],
            'skills_options' => [
                'Yoga', 'Weight Loss', 'Muscle Building', 'Physiotherapy', 'Kids Fitness',
                'Senior Fitness', 'Calisthenics', 'Postnatal Fitness'
                // 'Others' will be handled with a text input
            ],
            'time_slots_general' => ['Morning', 'Afternoon', 'Evening', 'Night'],
            'train_audience_options' => ['Men', 'Women', 'Kids', 'Seniors', 'All']
        ];
        return view('provider/onboarding', $data);
    }

    // Placeholder for handling provider onboarding form submission
    public function processOnboarding()
    {
        // $postData = $this->request->getPost();
        // Validate data
        // Handle KYC photo "submission" (paths to stored images, if live capture was simulated)
        // Handle KYC payment status (if integrated)
        // Save provider profile data to database
        // Mark provider onboarding as pending approval or complete (if auto-approved)
        // Redirect to provider dashboard or a "pending approval" page
        return redirect()->to('provider/onboarding')->with('message', 'Provider onboarding processing (including KYC and payment) will be implemented here.');
    }

    // Placeholder for initiating KYC payment (e.g., Razorpay order creation)
    public function processKycPayment()
    {
        // Create Razorpay order
        // Return order details to frontend for Razorpay checkout
        return redirect()->to('provider/onboarding')->with('message', 'KYC Payment initiation will be implemented here.');
    }

    public function viewClientRequests()
    {
        // In a real app:
        // 1. Get logged-in provider's details (skills, location, availability).
        // 2. Fetch client requests matching these criteria (within radius, matching skills, provider gender preference).
        // 3. Exclude requests already bid on, or show them differently.

        // Simulated client requests data (relevant to a hypothetical provider)
        $clientRequests = [
            [
                'id' => 301,
                'title' => 'Yoga Instructor for Beginners (Female Preferred)',
                'client_age_gender' => '35, Female', // Example
                'goals' => ['Yoga', 'Flexibility', 'Stress Relief'],
                'location_area' => 'Madhapur',
                'distance_from_provider' => 3.2, // Calculated
                'preferred_time_slots' => ['Morning (7-9 AM)', 'Weekend Afternoons'],
                'posted_on' => '2024-07-30',
                'notes' => 'Looking for someone patient and experienced with beginners.'
            ],
            [
                'id' => 302,
                'title' => 'Strength Training for Senior Citizen',
                'client_age_gender' => '72, Male',
                'goals' => ['Strength Training', 'Mobility', 'Senior Fitness'],
                'location_area' => 'Kondapur',
                'distance_from_provider' => 1.5,
                'preferred_time_slots' => ['Afternoon (3-5 PM)'],
                'posted_on' => '2024-07-29',
                'notes' => 'Needs gentle exercises, provider must have experience with seniors.'
            ],
            [
                'id' => 303,
                'title' => 'Postnatal Weight Loss Trainer',
                'client_age_gender' => '28, Female',
                'goals' => ['Weight Loss', 'Postnatal Recovery', 'Core Strength'],
                'location_area' => 'Gachibowli',
                'distance_from_provider' => 5.0,
                'preferred_time_slots' => ['Morning', 'Mid-day'],
                'posted_on' => '2024-07-31',
                'notes' => ''
            ]
        ];

        $data = [
            'clientRequests' => $clientRequests
        ];
        return view('provider/client_requests', $data);
    }

    public function placeBid($requestId = null)
    {
        // In a real app:
        // 1. Validate $requestId.
        // 2. Fetch client request details to display.
        // 3. Check if provider is eligible to bid (not bid already, matches criteria etc.).
        // 4. Pre-fill parts of the bid form from provider's profile if possible.

        if (!$requestId) {
            return redirect()->to('provider/requests')->with('error', 'Request ID not provided.');
        }

        // Simulated client request details for the bid form
        $clientRequestDetails = [
            'id' => $requestId,
            'title' => 'Yoga Instructor for Beginners (Female Preferred)', // Example, fetch based on $requestId
            'client_age_gender' => '35, Female',
            'goals' => ['Yoga', 'Flexibility', 'Stress Relief'],
            'location_area' => 'Madhapur',
            'preferred_time_slots' => ['Morning (7-9 AM)', 'Weekend Afternoons'],
            'notes' => 'Looking for someone patient and experienced with beginners.',
            // Add more details as needed for provider to make an informed bid
        ];

        // Example: if $requestId is 302
        if ($requestId == 302) {
            $clientRequestDetails['title'] = 'Strength Training for Senior Citizen';
            $clientRequestDetails['client_age_gender'] = '72, Male';
            $clientRequestDetails['goals'] = ['Strength Training', 'Mobility', 'Senior Fitness'];
            $clientRequestDetails['location_area'] = 'Kondapur';
            $clientRequestDetails['preferred_time_slots'] = ['Afternoon (3-5 PM)'];
            $clientRequestDetails['notes'] = 'Needs gentle exercises, provider must have experience with seniors.';
        }


        $data = [
            'request' => $clientRequestDetails,
            'price_types' => ['per month', 'per week', 'per hour', 'fixed total'] // For dropdown
        ];
        return view('provider/place_bid', $data);
    }

    // Placeholder for handling bid submission
    public function submitBid()
    {
        // $postData = $this->request->getPost();
        // $requestId = $postData['request_id'];
        // Validate data (price, availability, message)
        // Ensure provider is eligible (e.g., verified, hasn't bid on this request yet)
        // Save bid to database, linking to provider and client request
        // Notify client (optional, could be a separate process)
        // Redirect to provider dashboard or a "bid submitted" confirmation page
        return redirect()->to('provider/requests')->with('message', 'Bid submission processing will be implemented here.');
    }
}
