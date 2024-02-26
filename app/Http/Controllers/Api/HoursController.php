<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weekday;
use App\Models\Commerce;

class HoursController extends Controller
{
    public function index(Request $request){
        $commerce = Commerce::find($request->commerceId);
        $weekdays = Weekday::all();
        $firstDay = $weekdays->shift();
        $weekdays->push($firstDay);
    
        $hours = $commerce->weekdays;
    
        // Obtener los días de la semana de la tabla pivote
        $days = $weekdays->map(function($day) use ($hours) {
            $weekday = $hours->where('name', $day->name)->first();

            if ($weekday) {
                return [
                    'id' => $day->id,
                    'name' => $day->name,
                    'hour_open' => $weekday->pivot->hour_open,
                    'minute_open' => $weekday->pivot->minute_open,
                    'hour_close' => $weekday->pivot->hour_close,
                    'minute_close' => $weekday->pivot->minute_close,
                    'isSelected' => true
                ];
            }else {
                return [
                    'id' => $day->id,
                    'name' => $day->name,
                    'hour_open' => null,
                    'minute_open' => null,
                    'hour_close' => null,
                    'minute_close' => null,
                    'isSelected' => false
                ];
            }
        });
    
        return response()->json([
            'days' => $days,
            'commerce' => $commerce
        ]);
    }

    public function setHour(Request $request){
        $weekday = Weekday::find($request->id);
        $commerce = Commerce::find($request->commerceId);

        if ($request->selected) {
            $commerce->weekdays()->syncWithoutDetaching([
                $weekday->id => [
                    'hour_open' => $request->hourOpen,
                    'minute_open' => $request->minuteOpen,
                    'hour_close' => $request->hourClose,
                    'minute_close' => $request->minuteClose
                ]
            ]);
        } else {
            $commerce->weekdays()->detach($weekday->id);
        }

        return response()->json([
            'message' => 'sincronización exitosa',
        ]);
    
    }

    public function setHourEnable(Request $request){
        $commerce = Commerce::find($request->commerceId);
        $commerce->hourEnable = $request->hourEnable;
        $commerce->save();

        return response()->json([
            'message' => 'horario activado con exito',
        ]);
    }
}
