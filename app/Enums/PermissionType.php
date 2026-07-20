<?php

namespace App\Enums;

enum PermissionType: string
{
    case MANAGE_USERS = 'manage_users';
    case MANAGE_ROLES = 'manage_roles';
    case MANAGE_HERITAGE_SITES = 'manage_heritage_sites';
    case MANAGE_SITE_CATEGORIES = 'manage_site_categories';
    case MANAGE_FACILITY_USAGE_REQUESTS = 'manage_facility_usage_requests';
    case MANAGE_SITE_CONDITION_REPORTS = 'manage_site_condition_reports';
    case MANAGE_REPORTS = 'manage_reports';

    /**
     * Get the descriptive label for the permission.
     */
    public function label(): string
    {
        return match ($this) {
            self::MANAGE_USERS => 'Kelola Pengguna',
            self::MANAGE_ROLES => 'Kelola Hak Akses',
            self::MANAGE_HERITAGE_SITES => 'Kelola Lokasi Cagar Budaya',
            self::MANAGE_SITE_CATEGORIES => 'Kelola Kategori Situs',
            self::MANAGE_FACILITY_USAGE_REQUESTS => 'Kelola Permohonan Fasilitas',
            self::MANAGE_SITE_CONDITION_REPORTS => 'Kelola Laporan Kondisi',
            self::MANAGE_REPORTS => 'Kelola Laporan & Dashboard',
        };
    }
}
