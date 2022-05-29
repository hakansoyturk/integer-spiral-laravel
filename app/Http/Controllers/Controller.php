<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function createLayout(Request $request)
    {
        $tableRowSize = $request['x'];
        $tableColumnSize = $request['y'];
        $endingRowIndex = $request['y'];
        $endingColumnIndex = $request['x'];

        if (isset($endingRowIndex) && isset($endingColumnIndex)) {
            $startingRowIndex = 0;
            $startingColumnIndex = 0;
            $numbers = 0;
            $matris = [[]];
            while ($startingRowIndex < $endingRowIndex && $startingColumnIndex < $endingColumnIndex) {
                /* Print the first row from
            the remaining rows */
                for ($i = $startingColumnIndex; $i < $endingColumnIndex; ++$i) {
                    $matris[$startingRowIndex][$i] = $numbers;
                    $numbers++;
                }
                $startingRowIndex++;

                /* Print the last column
            from the remaining columns */
                for ($i = $startingRowIndex; $i < $endingRowIndex; ++$i) {
                    $matris[$i][$endingColumnIndex - 1] = $numbers;
                    $numbers++;
                }
                $endingColumnIndex--;

                /* Print the last row from
            the remaining rows */
                if ($startingRowIndex < $endingRowIndex) {
                    for ($i = $endingColumnIndex - 1; $i >= $startingColumnIndex; --$i) {
                        $matris[$endingRowIndex - 1][$i] = $numbers;
                        $numbers++;
                    }
                    $endingRowIndex--;
                }

                /* Print the first column from
            the remaining columns */
                if ($startingColumnIndex < $endingColumnIndex) {
                    for ($i = $endingRowIndex - 1; $i >= $startingRowIndex; --$i) {
                        $matris[$i][$startingColumnIndex] = $numbers;
                        $numbers++;
                    }
                    $startingColumnIndex++;
                }
            }
            Layout::create([
                'x_axis_size' => $tableRowSize,
                'y_axis_size' => $tableColumnSize,
                'data' => serialize($matris)
            ]);
            return response()->json([
                'layout_id' => Layout::orderBy('layout_id', 'desc')->first()->layout_id
            ]);
        } else {
            return response()->json([
                'error' => "x and y can't be empty!"
            ]);
        }
    }
    public function getLayouts()
    {
        return response()->json([
            Layout::all()
        ]);
    }
    public function getValueOfLayout(Request $request)
    {
        $layoutId = $request['id'];
        $xCoordinate = $request['x'];
        $yCoordinate = $request['y'];
        if (isset($layoutId) && isset($xCoordinate) && isset($yCoordinate)) {
            $xSizeForGivenId = Layout::where("layout_id", $layoutId)->first()->x_axis_size;
            $ySizeForGivenId = Layout::where("layout_id", $layoutId)->first()->y_axis_size;
            if (($xCoordinate < $xSizeForGivenId) && ($yCoordinate < $ySizeForGivenId)) {
                $result = unserialize(Layout::where("layout_id", $layoutId)->first()->data)[$yCoordinate][$xCoordinate];
                return response()->json([
                    "value_of_given_coordinate" => $result
                ]);
            } else {
                return response()->json([
                    'error' => "x and y must be smaller than layout's x and y!"
                ]);
            }
        } else {

            return response()->json([
                'error' => "x, y and id can't be empty!"
            ]);
        }
    }
}
