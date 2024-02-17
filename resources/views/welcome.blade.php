<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/46200442c7.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center p-3">Deportistas Club Ángeles</h1>
   @if (session("correcto"))
       <div class="alert alert-success">{{session("correcto")}}</div>
   @endif

   @if (session("incorrecto"))
   <div class="alert alert-danger">{{session("incorrecto")}}</div>
  @endif

  <script>
    var res=function(){
         var not=confirm("Estas seguro de eliminar el registro?");
         return not;
    } 
 </script>

  <!-- Modal Añadir producto-->
      <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">A continuación va a agregar un deportista
                  </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{route("crud.create")}}" method="POST">
                    @csrf
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Numero de documento</label>
                          <input type="text" class="form-control" id="exampleInputEmail1"
                              aria-describedby="emailHelp" name="txtcodigo">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombres y apellidos</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" name="txtnombre">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                      <input type="text" class="form-control" id="exampleInputEmail1"
                          aria-describedby="emailHelp" name="txtnacimiento">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Entidad promotora de salud EPS</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" name="txteps">
                </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Agregar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
    <div class="p-5 table-responsive">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Agregar deportista</button>
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white"><!--No responde-->
                <tr>
                    <th scope="col">DOCUMENTO</th>
                    <th scope="col">NOMBRES Y APELLIDOS</th>
                    <th scope="col">FECHA DE NACIMIENTO</th>
                    <th scope="col">ENTIDAD PROMOTORA DE SALUD</th>
                    <th></th>


                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos as $item)
                    <tr>
                        <th>{{ $item->documento }}</th>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->nacimiento }}</td>
                        <td>{{ $item->eps }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->documento }}"
                                class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route("crud.delete",$item->documento)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                        </td>


                        <!-- Modal Modificar datos-->
                        <div class="modal fade" id="modalEditar{{ $item->documento }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos del producto
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route("crud.update")}}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Numero de documento</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="txtcodigo" value="{{$item->documento}}" readonly>
                                            </div>
                                            <div class="mb-3">
                                              <label for="exampleInputEmail1" class="form-label">Nombres y apellidos</label>
                                              <input type="text" class="form-control" id="exampleInputEmail1"
                                                  aria-describedby="emailHelp" name="txtnombre" value="{{$item->nombre}}">
                                          </div>
                                          <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="txtnacimiento" value="{{$item->nacimiento}}">
                                        </div>
                                        <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Entidad promotora de salud EPS</label>
                                          <input type="text" class="form-control" id="exampleInputEmail1"
                                              aria-describedby="emailHelp" name="txteps" value="{{$item->eps}}">
                                      </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
