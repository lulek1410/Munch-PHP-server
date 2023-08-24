<?php

namespace App\Http\Controllers;

require_once 'Helpers/sortData.php';
require_once 'Helpers/handleValidationError.php';

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers;
use App\Models\Event;
use Illuminate\Validation\ValidationException;

use function App\Http\Controllers\Helpers\handleValidationError;

class BaseController  extends Controller
{
  protected $model;
  protected $path;
  protected $validationRules;
  protected $validationMessages;

  public function __construct($model, $validationRules, $validationMessages)
  {
    $this->model = $model;
    $this->validationRules = $validationRules;
    $this->validationMessages = $validationMessages;
    $this->path = Request::capture()->path();
  }

  function show(Request $request)
  {
    try {
      $data = $this->model::all()->toArray();
      $sort = $request->query('sort');
      if ($sort) {
        Helpers\sortData($sort, $data);
      }
      $size = count($data);
      return response()
        ->json($data, 200)
        ->withHeaders([
          'Content-Range' => 'pages 0/{$size}/{$size}'
        ]);
    } catch (Exception $e) {
      echo $e->getMessage() . '\n';
      return response()->json('Could not GET ' . $this->path, 400);
    }
  }

  function showSingle($id)
  {
    try {
      $data = $this->model::find($id);
      return response()->json($data, 200);
    } catch (Exception $e) {
      echo $e->getMessage() . '\n';
      return response()->json('Could not GET ' . $this->path, 400);
    }
  }

  function store(Request $request)
  {
    try {
      $data = $request->validate(
        $this->validationRules,
        $this->validationMessages
      );
      if ($this->model instanceof Event) {
        $data['postDate'] = date('Y-m-d');
      }
      $this->model->fill($data);
      $this->model->save();
      return response()->json(['message' => 'Item created'], 201);
    } catch (ValidationException $e) {
      return handleValidationError(response(), $e);
    }
  }

  function delete(Request $request)
  {
    try {
      $ids = array_filter(explode('"', $request->query('filter')), function ($value) {
        return strlen($value) === 24;
      });
      $this->model::whereIn('_id', $ids)->delete();
      return response()->json('OK', 200);
    } catch (Exception $e) {
      echo $e->getMessage() . '\n';
      return response()->json('Could not GET ' . $this->path, 400);
    }
  }

  function deleteOne($id)
  {
    try {
      $this->model::destroy($id);
      return response()->json('OK', 200);
    } catch (Exception $e) {
      echo $e->getMessage() . '\n';
      return response()->json('Could not GET ' . $this->path, 400);
    }
  }

  function update(Request $request, $id)
  {
    try {
      $this->model::where('_id', $id)->update($request->all());
      return response()->json('Element updated', 200);
    } catch (ValidationException $e) {
      return handleValidationError(response(), $e);
    }
  }
}
