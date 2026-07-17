<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacilityUsageRequest;

class FacilityUsageRequestSeeder extends Seeder
{
    public function run(): void
    {
        $requests = [
            [
                'request_number' => 'REQ-202607-001',
                'user_id' => 6, // Eko Visitor
                'heritage_site_id' => 1, // Prambanan
                'applicant_name' => 'Eko',
                'identity_number' => '3471234567890001',
                'institution_name' => 'Universitas Indonesia',
                'activity_type' => 'Penelitian Akademik',
                'activity_description' => 'Penelitian mengenai struktur bangunan candi',
                'start_date' => '2026-08-01',
                'end_date' => '2026-08-05',
                'duration_days' => 5,
                'participant_count' => 3,
                'application_letter_path' => 'docs/req-001.pdf',
                'status' => 'approved',
                'approval_notes' => 'Disetujui untuk area luar candi',
                'permit_number' => 'PRM-202607-001',
                'fee_amount' => 0,
                'reviewed_by' => 2, // Budi Site Manager
                'reviewed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        FacilityUsageRequest::insert($requests);
    }
}
