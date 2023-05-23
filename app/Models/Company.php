<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'foundation_date',
        'country',
        'zip_code',
        'city',
        'street_address',
        'latitude',
        'longitude',
        'owner',
        'employees',
        'activity',
        'active',
        'email',
        'password',
    ];
    
    /**
     * getFoundedCompanies
     *
     * @param  string|date $start
     * @param  string|date $end
     * @return array contains the result from database
     */
    public static function getFoundedCompanies($start, $end)
    {
        $start = $start ?? '2001-01-01';
        $end = $end ?? date('Y-m-d');

        $sql = "WITH RECURSIVE dates AS (
            SELECT '$start' AS date
            UNION ALL
            SELECT DATE_ADD(date, INTERVAL 1 DAY)
            FROM dates
            WHERE date < '$end'
            )
            SELECT date, name
            FROM dates
            LEFT JOIN companies ON date = foundation_date";

        return DB::select($sql);
    }
    
    /**
     * getCompaniesByActivities
     *
     * @return array contains the result from database
     */
    public static function getCompaniesByActivities(){

        DB::statement('SET @activity := NULL;');
        DB::statement('SET @sql := NULL;');

        DB::statement("SELECT GROUP_CONCAT(
            DISTINCT CONCAT(
                'CASE WHEN activity = ''', activity, ''' THEN name ELSE NULL END AS `', activity, '`'
            )
        ) INTO @activity
        FROM companies;");
        
        DB::statement("SET @sql := CONCAT(
            'SELECT ', @activity, ' 
            FROM companies 
            GROUP BY id'
        );");
        
        DB::statement('PREPARE stmt FROM @sql;');
        return DB::select('EXECUTE stmt', [], \PDO::FETCH_ASSOC);
    }
}
