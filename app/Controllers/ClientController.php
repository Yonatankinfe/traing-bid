<?php

namespace App\Controllers;

class ClientController extends BaseController
{
    public function onboarding()
    {
        // In a real app, ensure user is logged in, has selected 'client' role,
        // and hasn't completed onboarding yet.
        // if (!session()->get('isLoggedIn') || session()->get('role') !== 'client' || session()->get('client_onboarding_complete')) {
        //    return redirect()->to('/');
        // }

        // Data for form dropdowns, multi-selects etc.
        $data = [
            'genders' => ['Male', 'Female', 'Other'],
            'service_for_options' => ['Self', 'Parent', 'Child', 'Partner', 'Other'],
            'physical_conditions_options' => [
                'Knee pain', 'Back pain', 'Shoulder stiffness', 'Leg pain',
                'Post-surgery recovery'
                // 'Other' will be handled with a text input
            ],
            'goals_options' => [
                'Weight loss', 'Physiotherapy', 'Yoga', 'Muscle building', 'Kids fitness',
                'Postnatal recovery', 'Loose weight', 'Gain weight', 'General fitness',
                'Increase flexibility', 'Improve stamina', 'Cardio fitness', 'Strength training',
                'Calisthenics', 'Pilates', 'Pilates + Physio', 'Body transformation',
                'Senior wellness', 'Sports-specific training', 'Pain management'
                // 'Combination goal' and 'Other' will be handled with text inputs
            ],
            'time_slots_detailed' => $this->getDetailedTimeSlots(),
            'distance_options' => ['0-5 km', '0-10 km', '0-15 km', '0-25 km'],
            'preferred_trainer_genders' => ['Any', 'Male only', 'Female only']
        ];

        return view('client/onboarding', $data);
    }

    private function getDetailedTimeSlots(): array
    {
        $slots = [];
        for ($hour = 5; $hour <= 21; $hour++) { // 5 AM to 9 PM (ends at 10 PM)
            $time_start = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
            $time_end_hour = $hour + 1;
            $time_end = str_pad($time_end_hour, 2, '0', STR_PAD_LEFT) . ':00';

            $period_start = $hour < 12 ? 'AM' : 'PM';
            $display_hour_start = $hour % 12 === 0 ? 12 : $hour % 12;

            $period_end = $time_end_hour < 12 ? 'AM' : ($time_end_hour === 24 ? 'AM' : 'PM'); // Next day AM for 12 AM end
            $display_hour_end = $time_end_hour % 12 === 0 ? 12 : $time_end_hour % 12;
            if ($time_end_hour === 24) $display_hour_end = 12; // Adjust for 12 AM next day


            $slots[] = sprintf('%d:00 %s – %d:00 %s', $display_hour_start, $period_start, $display_hour_end, $period_end);
        }
        return $slots;
    }

    // Placeholder for handling onboarding form submission
    public function processOnboarding()
    {
        // $postData = $this->request->getPost();
        // Validate data
        // Save client profile data to database
        // Mark client onboarding as complete in session/db
        // Redirect to client dashboard or a success page
        return redirect()->to('client/onboarding')->with('message', 'Client onboarding processing will be implemented here.');
    }

    public function viewBids($requestId = null)
    {
        // In a real app:
        // 1. Validate $requestId.
        // 2. Check if the logged-in client owns this request.
        // 3. Fetch the actual request details from the database.
        // 4. Fetch bids associated with this request from the database.
        // 5. Fetch provider details for each bid.

        if (!$requestId) {
            // Or redirect to a page listing their requests
            return redirect()->to('/')->with('error', 'Request ID not provided.');
        }

        // Simulated request details
        $requestDetails = [
            'id' => $requestId,
            'title' => 'Looking for a Yoga Trainer for Weight Loss',
            'posted_on' => '2024-07-28',
            'location_summary' => 'Gachibowli, 0-10 km radius',
            'status' => 'Open for Bids'
        ];

        // Simulated bids data
        $bids = [
            [
                'id' => 101,
                'provider_id' => 201,
                'provider_name' => 'Trainer Priya Sharma',
                'provider_photo_url' => 'https://via.placeholder.com/80x80.png?text=Priya',
                'provider_tags' => ['Yoga', 'Weight Loss', 'Certified'],
                'distance_km' => 2.5,
                'price_quote' => '₹8,000 / month',
                'price_type' => 'monthly', // for potential structuring
                'availability' => 'Mon, Wed, Fri - Mornings (7-9 AM)',
                'message' => 'Hi! I have 5+ years of experience in Yoga and postnatal fitness. I can help you achieve your weight loss goals with a personalized plan.',
                'badges' => ['Verified', 'Top Rated'],
                'bid_received_on' => '2024-07-29'
            ],
            [
                'id' => 102,
                'provider_id' => 202,
                'provider_name' => 'Coach Anand Kumar',
                'provider_photo_url' => 'https://via.placeholder.com/80x80.png?text=Anand',
                'provider_tags' => ['Strength Training', 'Muscle Building'],
                'distance_km' => 7.1,
                'price_quote' => '₹1,200 / session (min 3 sessions/week)',
                'price_type' => 'per_session',
                'availability' => 'Tue, Thu - Evenings (6-8 PM); Sat - Afternoons',
                'message' => 'Expert in strength and conditioning. Let\'s build a plan tailored to your needs. Available for home visits.',
                'badges' => ['Verified'],
                'bid_received_on' => '2024-07-30'
            ],
            [
                'id' => 103,
                'provider_id' => 203,
                'provider_name' => 'Fitness Pro Rina Das',
                'provider_photo_url' => 'https://via.placeholder.com/80x80.png?text=Rina',
                'provider_tags' => ['Yoga', 'Pilates', 'Flexibility'],
                'distance_km' => 1.5, // Closest
                'price_quote' => '₹6,000 / month (3 days/week)',
                'price_type' => 'monthly',
                'availability' => 'Flexible on weekdays, preferably mornings or late afternoons.',
                'message' => 'Specializing in Yoga and Pilates for all levels. I focus on holistic well-being.',
                'badges' => ['Verified', 'Safe for Kids (example)'],
                'bid_received_on' => '2024-07-29'
            ]
        ];

        // Sort by distance (as per brief)
        usort($bids, function($a, $b) {
            return $a['distance_km'] <=> $b['distance_km'];
        });

        $data = [
            'request' => $requestDetails,
            'bids' => $bids
        ];

        return view('client/view_bids', $data);
    }
}
