<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 26.8.2017
 * Time: 16:10
 */

namespace TakeTick\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TakeTick\Priority;
use TakeTick\Status;
use TakeTick\Type;

class SettingsController extends Controller
{
    private $types;
    /**
     * @var Request
     */
    private $request;

    /**
     * SettingsController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function beforeCall()
    {
        parent::beforeCall();
        $this->types = [
            'status' => Status::class,
            'type' => Type::class,
            'priority' => Priority::class,
        ];
    }

    public function save($type, $id = 0)
    {
        /** @var Model $model */
        $model = new $this->types[$type];
        $fields = [
            'name' => $this->request->input('name'),
            'color' => $this->request->input('color'),
        ];
        if($type == 'priority') {
            $fields['priority'] = $this->request->input('priority');
        }
        if($id == 0) {
            $id = $model->insertGetId($fields);
        } else {
            $model->where("id_$type", $id)->update($fields);
        }
        return response()->json([
            'id' => $id
        ]);
    }

    public function delete($type, $id)
    {
        /** @var Model $model */
        $model = new $this->types[$type];
        $model->where("id_$type", $id)->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}