@extends('layout.app')

@section('contenido')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="row justify-content-center w-100">
        <!-- Ventas -->
        @can('venta-crear')
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card shadow-sm border-0 text-center h-100" style="background-color: #f28b82;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold text-white">Ventas</h2>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="150px" height="150px" viewBox="0 0 1024 1024"
                        class="icon" version="1.1">
                        <path
                            d="M960.1 258.4H245.8l-36.1-169H63.9v44h110.2l26.7 125 100.3 469.9 530 0.4v-44l-494.4-0.3-22.6-105.9H832l128.1-320.1z m-65 44L855.6 401H276.3l-21.1-98.6h639.9zM304.8 534.5L279.7 417h569.5l-47 117.5H304.8z"
                            fill="#39393A" />
                        <path
                            d="M375.6 810.6c28.7 0 52 23.3 52 52s-23.3 52-52 52-52-23.3-52-52 23.3-52 52-52m0-20c-39.7 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.3-72-72-72zM732 810.6c28.7 0 52 23.3 52 52s-23.3 52-52 52-52-23.3-52-52 23.3-52 52-52m0-20c-39.7 0-72 32.2-72 72s32.2 72 72 72c39.7 0 72-32.2 72-72s-32.3-72-72-72zM447.5 302.4h16v232.1h-16zM652 302.4h16v232.1h-16z"
                            fill="#E73B37" />
                            <path d="M276.3 401l3.4 16-3.4-16z" fill="#343535" />
                    </svg>

                        </div>
                    </div>
                    <a href="{{ route('ventas.index') }}" class="btn btn-light btn-lg w-75 mx-auto">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

        <!-- Categorías -->
        @can('categoria-listar')
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card shadow-sm border-0 text-center h-100" style="background-color: #90caf9;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold text-white">Categorías</h2>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="150px" height="150px" viewBox="0 0 48 48">
                                <title>category-list-solid</title>
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="invisible_box" data-name="invisible box">
                                        <rect width="48" height="48" fill="none" />
                                    </g>
                                    <g id="icons_Q2" data-name="icons Q2">
                                        <path d="M24,10h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,10Z" />
                                        <path d="M24,24h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,24Z" />
                                        <path d="M24,38h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,38Z" />
                                        <path
                                            d="M12,2a2.1,2.1,0,0,0-1.7,1L4.2,13a2.3,2.3,0,0,0,0,2,1.9,1.9,0,0,0,1.7,1H18a2.1,2.1,0,0,0,1.7-1,1.8,1.8,0,0,0,0-2l-6-10A1.9,1.9,0,0,0,12,2Z" />
                                        <path d="M12,30a6,6,0,1,1,6-6A6,6,0,0,1,12,30Z" />
                                        <path d="M16,44H8a2,2,0,0,1-2-2V34a2,2,0,0,1,2-2h8a2,2,0,0,1,2,2v8A2,2,0,0,1,16,44Z" />
                                    </g>
                                </g>
                            </svg>
    
                        </div>
                    </div>
                    <a href="{{ route('categorias.index') }}" class="btn btn-light btn-lg w-75 mx-auto">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

        <!-- Productos -->
        @can('producto-listar')
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card shadow-sm border-0 text-center h-100" style="background-color: #a5d6a7;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold text-white">Productos</h2>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"
                        height="150px" width="150" version="1.1" id="Capa_1" viewBox="0 0 372.372 372.372"
                        xml:space="preserve">
                        <g>
                            <path
                                d="M368.712,219.925c-5.042-8.951-14.563-14.511-24.848-14.511c-4.858,0-9.682,1.27-13.948,3.672l-83.024,46.756   c-1.084,0.61-1.866,1.642-2.163,2.85c-1.448,5.911-4.857,14.164-12.865,19.911c-8.864,6.361-20.855,7.686-35.466,3.939   c-0.088-0.022-0.175-0.047-0.252-0.071L148.252,267.6c-2.896-0.899-4.52-3.987-3.621-6.882c0.72-2.316,2.83-3.872,5.251-3.872   c0.55,0,1.101,0.084,1.634,0.249l47.645,14.794c0.076,0.023,0.154,0.045,0.232,0.065c11.236,2.836,20.011,2.047,26.056-2.288   c7.637-5.48,8.982-15.113,9.141-16.528c0.006-0.045,0.011-0.09,0.014-0.136c0.003-0.023,0.004-0.036,0.005-0.039   c0.001-0.015,0.002-0.03,0.003-0.044c0.001-0.01,0.001-0.019,0.002-0.029c0.909-11.878-6.756-22.846-18.24-26.089l-0.211-0.064   c-0.35-0.114-35.596-11.626-58.053-18.034c-2.495-0.711-9.37-2.366-19.313-2.366c-13.906,0-34.651,3.295-54.549,19.025   L1.67,292.159c-1.889,1.527-2.224,4.278-0.758,6.215l44.712,59.06c0.725,0.956,1.801,1.584,2.99,1.744   c0.199,0.027,0.398,0.04,0.598,0.04c0.987,0,1.954-0.325,2.745-0.935l57.592-44.345c1.294-0.995,3.029-1.37,4.619-0.995   l93.02,21.982c6.898,1.63,14.353,0.578,20.523-2.9l130.16-73.304C371.555,251.012,376.418,233.61,368.712,219.925z" />
                            <path
                                d="M316.981,13.155h-170c-5.522,0-10,4.477-10,10v45.504c0,5.523,4.478,10,10,10h3.735v96.623c0,5.523,4.477,10,10,10h142.526   c5.523,0,10-4.477,10-10V78.658h3.738c5.522,0,10-4.477,10-10V23.155C326.981,17.632,322.503,13.155,316.981,13.155z    M253.016,102.417h-42.072c-4.411,0-8-3.589-8-8c0-4.411,3.589-8,8-8h42.072c4.411,0,8,3.589,8,8   C261.016,98.828,257.427,102.417,253.016,102.417z M306.981,58.658h-3.738H160.716h-3.735V33.155h150V58.658z" />
                        </g>
                    </svg>

                        </div>
                    </div>
                    <a href="{{ route('productos.index') }}" class="btn btn-light btn-lg w-75 mx-auto">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

        <!-- Usuarios -->
        @can('usuario-activar')
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card shadow-sm border-0 text-center h-100" style="background-color: #ffcc80;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold text-white">Usuarios</h2>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="150px" height="150px"
                        viewBox="-32 0 512 512">
                        <path
                            d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm95.8 32.6L272 480l-32-136 32-56h-96l32 56-32 136-47.8-191.4C56.9 292 0 350.3 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-72.1-56.9-130.4-128.2-133.8z" />
                    </svg>

    
                        </div>
                    </div>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-light btn-lg w-75 mx-auto">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

        <!-- Reportes -->
        @can('reporte-generar')
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card shadow-sm border-0 text-center h-100" style="background-color: #b0bec5;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold text-white">Reportes</h2>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"
                            height="150px" width="150px" version="1.1" id="Layer_1" viewBox="0 0 512 512"
                            xml:space="preserve">
                            <g transform="translate(1 1)">
                                <g>
                                    <g>
                                        <path
                                            d="M472.6,16.067H37.4c-21.333,0-38.4,17.067-38.4,38.4v260.267v38.4c0,21.333,17.067,38.4,38.4,38.4h163.84l-12.8,51.2     h-1.707c-23.893,0-42.667,18.773-42.667,42.667c0,5.12,3.413,8.533,8.533,8.533h204.8c5.12,0,8.533-3.413,8.533-8.533     c0-23.893-18.773-42.667-42.667-42.667h-1.707l-12.8-51.2H472.6c21.333,0,38.4-17.067,38.4-38.4v-38.4V54.467     C511,33.133,493.933,16.067,472.6,16.067z M16.067,54.467c0-11.947,9.387-21.333,21.333-21.333h435.2     c11.947,0,21.333,9.387,21.333,21.333V306.2H16.067V54.467z M348.013,476.867H162.84c3.413-10.24,12.8-17.067,23.893-17.067     h8.533h119.467h9.387C335.213,459.8,344.6,466.627,348.013,476.867z M303.64,442.733h-97.28l12.8-51.2h71.68L303.64,442.733z      M493.933,353.133c0,11.947-9.387,21.333-21.333,21.333H297.667h-85.333H37.4c-11.947,0-21.333-9.387-21.333-21.333v-29.867     h477.867V353.133z" />
                                        <path
                                            d="M67.267,229.4v17.067v42.667h68.267v-42.667V229.4v-42.667H67.267V229.4z M118.467,272.067H84.333v-25.6h34.133V272.067z      M84.333,203.8h34.133v25.6H84.333V203.8z" />
                                        <path
                                            d="M144.067,229.4v17.067v42.667h68.267v-42.667V229.4v-76.8h-68.267V229.4z M195.267,272.067h-34.133v-25.6h34.133V272.067     z M161.133,169.667h34.133V229.4h-34.133V169.667z" />
                                            <path
                                            d="M220.867,229.4v17.067v42.667h68.267v-42.667V229.4v-128h-68.267V229.4z M272.067,272.067h-34.133v-25.6h34.133V272.067z      M237.933,118.467h34.133V229.4h-34.133V118.467z" />
                                        <path
                                        d="M297.667,229.4v17.067v42.667h68.267v-42.667V229.4v-68.267h-68.267V229.4z M348.867,272.067h-34.133v-25.6h34.133     V272.067z M314.733,178.2h34.133v51.2h-34.133V178.2z" />
                                        <path
                                            d="M374.467,229.4v17.067v42.667h68.267v-42.667V229.4V50.2h-68.267V229.4z M425.667,272.067h-34.133v-25.6h34.133V272.067z      M391.533,67.267h34.133V229.4h-34.133V67.267z" />
                                            <path
                                            d="M127,58.733H84.333c-5.12,0-8.533,3.413-8.533,8.533s3.413,8.533,8.533,8.533h22.187l-45.227,45.227     c-3.413,3.413-3.413,8.533,0,11.947c1.707,1.707,3.413,2.56,5.973,2.56s4.267-0.853,5.973-2.56l45.227-45.227v22.187     c0,5.12,3.413,8.533,8.533,8.533s8.533-3.413,8.533-8.533V67.267C135.533,62.147,132.12,58.733,127,58.733z" />
                                    </g>
                                </g>
                            </g>
                        </svg>
    
                        </div>
                    </div>
                    <a href="{{ route('reportes.index') }}" class="btn btn-light btn-lg w-75 mx-auto">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
@endsection