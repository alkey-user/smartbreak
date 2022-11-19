<?php
/**
 * File:	/app/Helpers/helpers.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 14th, 2021 5:49pm
 * -----
 * Last Modified: 	April 23rd 2021 12:03:02 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application 
 * developed during the PON course "The AppFactory" 2020-2021 with teachers 
 * & students of "Informatica e Telecomunicazioni" 
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 * 
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along 
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices 
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
<?php

function formatPrice($amount)
{
    return number_format($amount, 2, ',', '.').' €';
}
/**
 * formatShortDate
 *
 * @param date $date
 * @return string day-Month
 */
function formatShortDate($date)
{
    return
        $date instanceof Carbon\Carbon ?
        $date->format('d/m/Y') :
        Carbon\Carbon::parse($date)->translatedFormat('d-M');
}

/**
 * formatDate
 *
 * @param date $date
 * @return string dd-mm-aa
 */
function formatDate($date)
{
    return
        $date instanceof Carbon\Carbon ?
        $date->format('d/m/Y') :
        Carbon\Carbon::parse($date)->format('d/m/Y');
}

/**
 * isOrderTime
 * 
 * Check if now is order time or not
 *
 * @return boolean
 */
function isOrderTime(){
        //get config timerange variable
        $time_range = config('smartbreak.orders_timerange');
        $current_hour = now()->toTimeString(); //hh:mm:ss
        
        if (!$time_range['enabled']){
                return true;
            } elseif ($current_hour >= $time_range['from'] && $current_hour <= $time_range['to']){
                    return true;
                } else {
                    return false;            
        }
}
