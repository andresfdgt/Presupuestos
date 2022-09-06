<?php

namespace App\Http\Controllers;

use App\Helpers\CustomResponse;
use App\Http\Controllers\Controller;
use App\Models\Articulos;
use App\Models\Clientes;
use App\Models\Presupuestos;
use App\Models\User;
use App\Models\Versiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Empty_;

use App\Models\Colores;
use App\Models\Ivas;
use App\Models\Numeraciones;

class PresupuestoController extends Controller
{

  public function index(Request $request)
  {
    return view('presupuestos/nuevo2');
  }

  public function crear()
  {
    $referencias = Numeraciones::where("tipo_serie", 'Presupuestos')->select("id", "identificador", "favorito")->get();
    $ivas = Ivas::select("id", "descripcion", "iva")->get();
    return view('presupuestos/nuevo2', compact('referencias', 'ivas'));
  }

  public function store(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'referencia_uno' => 'required',
      'referencia_dos' => 'required',
      'referencia_tres' => 'required',
      'cliente' => 'required',
      'nombre_comercial' => 'required',
    ]);

    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }

    if (empty($request->id)) {
      $presupuesto = new Presupuestos();
    } else {
      $presupuesto = Presupuestos::find($request->id);
    }
    $presupuesto->referencia_uno = $request->referencia_uno;
    $presupuesto->referencia_dos = $request->referencia_dos;
    $presupuesto->referencia_tres = $request->referencia_tres;
    $presupuesto->cliente = $request->cliente;
    $presupuesto->nombre_comercial = $request->nombre_comercial;
    $presupuesto->usuario_id = Auth::id();
    if ($presupuesto->save()) {
      return CustomResponse::success("Presupuesto registrado correctamente", $presupuesto->id);
    } else {
      return CustomResponse::error("Vuelva a intentarlo", 200);
    }
  }

  public function storeVersion(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'titulo' => 'required',
      'fecha' => 'required',
      'estado' => 'required',
    ]);

    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }

    if (empty($request->id)) {
      $presupuesto = new Versiones();
      $presupuesto->version = Versiones::where("presupuesto_id", $request->presupuesto_id)->max('version') + 1;
    } else {
      $presupuesto = Versiones::find($request->id);
    }
    $presupuesto->titulo = $request->titulo;
    $presupuesto->estado = $request->estado;
    $presupuesto->fecha = $request->fecha;
    $presupuesto->presupuesto_id = $request->presupuesto_id;
    if ($presupuesto->save()) {
      return CustomResponse::success("Version registrada correctamente", $presupuesto->id);
    } else {
      return CustomResponse::error("Vuelva a intentarlo", 200);
    }
  }

  public function versiones($tipo, $id)
  {
    $where = [
      ["id", "=", $id]
    ];
    if ($tipo == "presupuesto") {
      $where = [
        ["presupuesto_id", "=", $id]
      ];
    }
    $versiones = Versiones::where($where)->get();
    return response()->json($versiones);
  }

  public static function clientes(Request $request)
  {
    $clientes = Clientes::select("nombre_fiscal as text", "id")->where('nombre_fiscal', 'LIKE', "%$request->search%")->orWhere('nombre_comercial', 'LIKE', "%$request->search%")->orWhere('cif', 'LIKE', "%$request->search%")->orWhere('domicilio', 'LIKE', "%$request->search%")->orWhere('telefono_principal', 'LIKE', "%$request->search%")->orWhere('telefono_secundario', 'LIKE', "%$request->search%")->orWhere('telefono_movil', 'LIKE', "%$request->search%")->orWhere('email', 'LIKE', "%$request->search%")->orWhere('localidad', 'LIKE', "%$request->search%")->orWhere('provincia', 'LIKE', "%$request->search%")->orderBy("nombre_fiscal")->get()->toArray();

    return response()->json(["results" => $clientes]);
  }

  public static function clienteById($id)
  {
    return response()->json(
      Clientes::select("nombre_comercial")->where('id', $id)->first()
    );
  }

  public static function buscar(Request $request)
  {
    $eventos = Articulos::select("nombre as text", "id", "desc_adicional", "preciobase", "iva", "iva_id")->where('referencia', 'LIKE', "%$request->search%")->orwhere('nombre', 'LIKE', "%$request->search%")->orderBy("referencia")->get()->toArray();

    return response()->json(["results" => $eventos]);
  }

  public function articulos(Request $request)
  {
    // if(empty($request->id)){
      $articulos = Articulos::get();
      $data = array();
      foreach ($articulos as $key => $articulo) {
        $subdata = array();
        $subdata[] = $key + 1;
        $subdata[] = $articulo->referencia;
        $subdata[] = $articulo->nombre;
        $subdata[] = $articulo->preciobase;
        $subdata[] = $articulo->iva;
        $subdata[] = $articulo->recargo;
        $subdata[] = "<button class='btn btn-sm btn-success agregarArticulo' data-click='$articulo'><i class='fa fa-plus'></i></button>";
        $data[] = $subdata;
      }
      return response()->json(array("data" => $data));
    // } else {

    // }
  }
}
