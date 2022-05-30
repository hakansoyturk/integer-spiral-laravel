<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *    title="Integer Spiral API Documentation",
 *    version="1.0.0",
 *      description="Integer Spiral Project API's Request and Response Values",
 *      @OA\Contact(
 *          email="hakan.syturk@gmail.com"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @OA\Post(
     *      path="/api/createlayout",
     *      operationId="creatingLayout",
     *      tags={"Requests"},
     *      summary="Creates a layout with spiral form, takes 2 parameter and returns id of layout.",
     *      description="Creates a layout with spiral form, takes 2 parameter which are x and y. Returns id of created layout.",
     *
     *     @OA\Parameter(
     *          name="x",
     *          description="Size of x axis",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="y",
     *          description="Size of y axis",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     )
     */
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
                'layout_id' => Layout::orderBy('id', 'desc')->first()->id
            ]);
        } else {
            return response()->json([
                'error' => "x and y can't be empty!"
            ]);
        }
    }
    /**
     * @OA\Get(
     *      path="/api/getlayouts",
     *      operationId="gettingLayout",
     *      tags={"Requests"},
     *      summary="List all layouts",
     *      description="Returns all informations of layouts.",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function getLayouts()
    {
        return response()->json([
            Layout::all()
        ]);
    }
    /**
     * @OA\Get(
     *      path="/api/getvalue",
     *      operationId="gettingValue",
     *      tags={"Requests"},
     *      summary="Returns coordinate according to x and y values",
     *      description="Returns the cell value of the layout according to the entered id, x and y coordinate values.",
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Id of layout",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="x",
     *          description="x coordinate",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="y",
     *          description="y coordinate",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function getValueOfLayout(Request $request)
    {
        $layoutId = $request['id'];
        $xCoordinate = $request['x'];
        $yCoordinate = $request['y'];
        if (isset($layoutId) && isset($xCoordinate) && isset($yCoordinate)) {
            $xSizeForGivenId = Layout::where("id", $layoutId)->first()->x_axis_size;
            $ySizeForGivenId = Layout::where("id", $layoutId)->first()->y_axis_size;
            if (($xCoordinate < $xSizeForGivenId) && ($yCoordinate < $ySizeForGivenId)) {
                $result = unserialize(Layout::where("id", $layoutId)->first()->data)[$yCoordinate][$xCoordinate];
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
