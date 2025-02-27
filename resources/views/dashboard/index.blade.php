@extends('layout.app')
@section('contenido')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="small-box  bg-gradient" style="background-color: #f28b82">
                    <div class="inner">
                        <h3>Ventas</h3>
                        <p>Nueva Venta</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="small-box bg bg-gradient" style="background-color: #90caf9">
                    <div class="inner">
                        <h3>Categorías</h3>
                        <p>Gestión de categorías</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="{{route('categorias.index')}}" class="small-box-footer">
                        Más info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="small-box bg-gradient" style="background-color: #a5d6a7">
                    <div class="inner">
                        <h3>Productos</h3>
                        <p>Administración de stock</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="small-box bg-gradient" style="background-color: #ffcc80">
                    <div class="inner">
                        <h3>Usuarios</h3>
                        <p>Control de empleados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="small-box bg-gradient" style="background-color: #b0bec5">
                    <div class="inner">
                        <h3>Reportes</h3>
                        <p>Resumen de ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
