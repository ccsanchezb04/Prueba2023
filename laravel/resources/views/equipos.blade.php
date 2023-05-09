@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.formulario')
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            @include('layouts.tabla')
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            initDatatable();
        });

        $("#btnGuardar").click(function(e) {
            e.preventDefault();
            let validate = formValidate("#formEquipo");

            let dataSend = $("#formEquipo").serialize();

            if (validate) {
                axios.post('/equipos/save', dataSend)
                    .then((response) => {
                        if (response.data.status) {
                            swal({
                                title: "Éxito!",
                                text: response.data.msm,
                                icon: "success",
                            });

                            cleanForm();
                            $('#tblEquipos').DataTable().destroy();
                            initDatatable();
                        } else {
                            swal({
                                title: "Error!",
                                text: "No se puede procesar el registro",
                                icon: "error",
                            });
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        swal({
                            title: "Error!",
                            text: "No se puede procesar el registro",
                            icon: "error",
                        });
                    })
            }
        });

        function initDatatable() {
            $('#tblEquipos').DataTable({
                "autoWidth": false,
                "language": {
                    "url": "/js/datatable/Spanish.json"
                },
                processing: true,
                serverSide: false,
                pagination: false,
                ajax: '/equipos/all',
                columns: [{
                        data: 'gce_nombre_equipo'
                    },
                    {
                        data: 'gce_board'
                    },
                    {
                        data: 'gce_case'
                    },
                    {
                        data: 'gce_procesador'
                    },
                    {
                        data: 'gce_grafica'
                    },
                    {
                        data: 'gce_ram'
                    },
                    {
                        data: 'gce_disco_duro'
                    },
                    {
                        data: 'gce_teclado'
                    },
                    {
                        data: 'gce_mouse'
                    },
                    {
                        data: 'gce_pantalla'
                    },
                    {
                        data: 'gce_estado',
                        render: function(data, type, row) {
                            let dataStatus = {};
                            if (data == 1) {
                                dataStatus.check = 'checked="true"';
                                dataStatus.state = 'Activo';
                            } else {
                                dataStatus.check = ' ';
                                dataStatus.state = 'Inactivo';
                            }

                            let checkStatus = '<input type="checkbox" id="checkStatus-' + row.gce_id +
                                '" ' + dataStatus.check + ' data-toggle="toggle" data-id="' + row.gce_id +
                                '" data-state="' + data + '" onchange="changeStatus(this)"><span>' +
                                dataStatus.state + '</span>';

                            return checkStatus;
                        }
                    },
                    {
                        data: 'gce_id',
                        render: function(data, type, row) {
                            let btnUpdate =
                                '<button type="button" class="btn btn-sm btn-primary btnEdit" id="btnEdit-' +
                                row.gce_id + '" data-id="' + row.gce_id +
                                '" data-action="edit" onclick="editEquipo(this)"><i class="fa-solid fa-pen-to-square"></i> Editar</button>';
                            let btnDelete =
                                '<button type="button" class="btn btn-sm btn-danger btnDelete" id="btnDelete-' +
                                row.gce_id + '" data-id="' + row.gce_id +
                                '" onclick="deleteEquipo(this)"><i class="fa-solid fa-trash"></i> Borrar</button>';
                            return btnUpdate + ' ' + btnDelete;
                        }
                    },
                ]
            });
        }

        function editEquipo(element) {

            let idEquipo = $(element).data('id');
            let infoEquipo = '';

            cleanForm();

            axios.get('/equipos/getEquipoById', {
                    params: {
                        "idEquipo": idEquipo
                    }
                })
                .then((response) => {
                    if (response.data.status) {
                        infoEquipo = response.data.data;

                        $.each(infoEquipo, (indexInArray, valueOfElement) => {
                            $("[name='gce_caracteristicas[" + indexInArray + "]']").val(valueOfElement);
                        });

                        // $('#formEquipo select').trigger('change');

                    } else {
                        swal({
                            title: "Error!",
                            text: "No se pudo cargar la información solicitada",
                            icon: "error",
                        });
                    }
                })
                .catch((error) => {
                    swal({
                        title: "Error!",
                        text: "No se pudo cargar la información solicitada",
                        icon: "error",
                    });
                });
        }

        function changeStatus(element) {
            let idEquipo = $(element).data('id');
            let state = $(element).data('state');

            let dataSend = {
                "idEquipo": idEquipo,
                "status": (state == 1) ? 0 : 1
            }

            axios.post('/equipos/changeStatus', dataSend)
                .then((response) => {
                    if (response.data.status) {
                        swal({
                            title: "Éxito!",
                            text: response.data.msm,
                            icon: "success",
                        });

                        $('#tblEquipos').DataTable().destroy();
                        initDatatable();
                    } else {
                        swal({
                            title: "Error!",
                            text: "No se puede procesar el registro",
                            icon: "error",
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    swal({
                        title: "Error!",
                        text: "No se puede procesar el registro",
                        icon: "error",
                    });
                });
        }

        function deleteEquipo(element) {
            let idEquipo = $(element).data('id');

            swal("¿Desea eliminar este registro?", {
                    buttons: {
                        cancel: {
                            text: "Cancelar",
                            value: false,
                            visible: true,
                            className: "",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Borrar",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        }
                    },
                })
                .then((value) => {
                    if (value) {
                        axios.post('/equipos/delete', {"idEquipo": idEquipo})
                            .then((response) => {
                                if (response.data.status) {
                                    swal({
                                        title: "Éxito!",
                                        text: response.data.msm,
                                        icon: "success",
                                    });

                                    $('#tblEquipos').DataTable().destroy();
                                    initDatatable();
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "No se puede eliminar este registro",
                                        icon: "error",
                                    });
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                                swal({
                                    title: "Error!",
                                    text: "No se puede eliminar este registro",
                                    icon: "error",
                                });
                            });
                    }
                });

        }

        function cleanForm() {
            $("#formEquipo input, #formEquipo select").val('');
        }
    </script>
@endsection
