<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
class StylistForm extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','status','video_name','product_ids','merchant_id'];
    


   public function list(){
        $status = ['1','0'];
       return  StylistForm::whereIn('status', $status)->where("merchant_id", Auth::id())->orderBy('updated_at','desc')->paginate(10);
   }

    public function add(Request $request ){

        $obj = new StylistForm();
        $data = array();
        $data['name'] = $request->name;
        $data['slug'] =  $request->slug;
        $data['status'] = $request->required;
        $data['product_ids'] = implode(',',$request->product_ids);
        $merchant_id = Auth::id();
        $data['merchant_id'] = $merchant_id;
        if(isset($request->video_url)){
		}else{
			$data['video_name'] = $request->video_name;
		}
        $data['status'] = $request->status;
        if(isset($request->id)){
            $obj =  StylistForm::find($request->id);
            if(isset($obj)){
                if($obj->update($data)){
                    $data['id'] = $request->id;
                 return (object) $data;
                }

            }

        }
        return $obj->create($data);

    }
    
    public function get($id = 0){

        return $obj = StylistForm::find($id);

    }
    
    
    function udpateRowInfo(Request $request){

        $row_id  = $request->row_id;
        $column_name =  $request->column_name;
        $update_value = $request->update_value;
       
        $obj = StylistForm::find($row_id);
      
        if (isset($obj)) {
			$obj->$column_name = $update_value;
			$obj->updated_at = date("Y-m-d H:i:s");
            $obj->save();

        }
        return $obj;

    }
    function delete($id = 0){

       	return StylistForm::where('id', '=',$id)->delete();

    }
    
    
    public function getValueByColumn($column_name = '', $value = ''){

        return  StylistForm::where([['status', '=', '1'],[$column_name, '=', $value]])->first();

    }

}
