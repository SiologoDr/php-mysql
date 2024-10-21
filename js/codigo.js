//Funciones de proyecto.
$(function() {
    $(".reg_proyecto .btn_mostrar").click(function(e){
        let codproy = $(this).closest(".reg_proyecto").children(".codproy").text();

        location.href = "mostrar_proyecto.php?codproy="+codproy;
    });

    $(".reg_proyecto .btn_editar").click(function(e){
        let codproy = $(this).closest(".reg_proyecto").children(".codproy").text();

        location.href = "editar_proyecto.php?codproy="+codproy
    });

    $(".reg_proyecto .btn_borrar").click(function(e){
        let codproy = $(this).closest(".reg_proyecto").children(".codproy").text();
        let proy = $(this).closest(".reg_proyecto").children(".proy").text();

        $("#md_borrar .lbl_codproy").text(codproy);
        $("#md_borrar .lbl_proy").text(proy);

        $("#md_borrar .btn_borrar").attr("href","../../controlador/proyecto/ctr_borrar_proy.php?cod_proy="+codproy);
        $("#md_borrar").modal("show");
    })

    $("#frm_consultar_proy #btn_buscar").click(function(){
        var codproy = $("#txt_codproy").val();

        if(codproy.trim() === "") {
            alert("Por favor, ingresa un código de área.");
            return;
        }

        $.ajax({
            url:"../../controlador/proyecto/ctr_consultar_proy.php",
            type: "POST",
            data: {cod_proy: codproy},
            success: function(response) {
                var data = JSON.parse(response);

                if (data) {
                    $(".modal-codproy").text(data.codigo_proyecto);
                    $(".modal-proyecto").text(data.proyecto);
                    $(".modal-descripcion").text(data.descripcion);
                    $("#dataModal").modal("show");
                }
                else {
                    alert("Área no encontrada.");
                }
            },
            error: function() {
                alert("Hubo un error en la búsqueda.");
            }

        })
    });
    
    $("#frm_filtrar_proy #btn_filtrar").on("click", function(e){
        e.preventDefault();
        console.log("Botón de filtrar clicado");
        var valor=$("#txt_valor").val();
        console.log("Valor para filtrar: " + valor);

        if (valor!=""){
            $.post("../../controlador/proyecto/ctr_filtrar_proy.php",
                {valor:valor},
                function(rpta){
                    console.log("Respuesta del servidor: ", rpta); 
                    $("#tabla").html(rpta);
                });
            }else{
                $("#tabla").html("");
                alert("Escriba un valor para filtrar...");
                $("#txt_valor").focus();
            }
    });
})


//Funciones de Cliente.
$(function(){
    $(".reg_cliente .btn_mostrar").click(function(e){
        let codclient = $(this).closest(".reg_cliente").children(".codclient").text();

        location.href = "mostrar_cliente.php?codclient="+codclient;
    });

    $(".reg_cliente .btn_editar").click(function(e){
        let codclient = $(this).closest(".reg_cliente").children(".codclient").text();

        location.href = "editar_cliente.php?codclient="+codclient;
    });

    $(".reg_cliente .btn_borrar").click(function(e){
        let codclient = $(this).closest(".reg_cliente").children(".codclient").text();
        let client = $(this).closest(".reg_cliente").children(".client").text();

        $("#md_borrar .lbl_codclient").text(codclient);
        $("#md_borrar .lbl_client").text(client);

        $("#md_borrar .btn_borrar").attr("href","../../controlador/cliente/ctr_borrar_cli.php?cod_cli="+codclient);
        $("#md_borrar").modal("show");
    });

    $("#frm_consultar_client #btn_buscar").click(function(){
       var codclient = $("#txt_codcli").val();

       if(codclient.trim() === "") {
            alert("Por favor, ingresa un código de área.");
            return;
       }

       $.ajax({
        url: "../../controlador/cliente/ctr_consultar_cli.php",
        type: "POST",
        data: {cod_cli: codclient},
        success: function(response) {
            var data = JSON.parse(response);

            if(data) {
                $(".modal-codclient").text(data.codigo_cliente);
                $(".modal-cliente").text(data.nombre_cliente);
                $(".modal-email").text(data.email);
                $("#dataModal").modal("show");
            }
            else {
                alert("Área no encontrada.");
            }
        },
        error: function() {
            alert("Hubo un error en la búsqueda.");
        }
       })
    });

    $("#frm_filtrar_client #btn_filtrar").on("click", function(e){
        e.preventDefault();
        console.log("Botón de filtrar clicado");
        var valor=$("#txt_valor").val();
        console.log("Valor para filtrar: " + valor);

        if (valor!=""){
            $.post("../../controlador/cliente/ctr_filtrar_cli.php",
                {valor:valor},
                function(rpta){
                    console.log("Respuesta del servidor: ", rpta); 
                    $("#tabla").html(rpta);
                });
            }else{
                $("#tabla").html("");
                alert("Escriba un valor para filtrar...");
                $("#txt_valor").focus();
            }
    });
});

//Funciones de Empleado
$(function(){
    $(".reg_empleado .btn_mostrar").click(function(e){
        let codemp = $(this).closest(".reg_empleado").children(".codemp").text();

        location.href = "mostrar_empleado.php?codemp="+codemp;
    });

    $(".reg_empleado .btn_editar").click(function(e){
        let codemp = $(this).closest(".reg_empleado").children(".codemp").text();

        location.href = "editar_empleado.php?codemp="+codemp;
    });

    $(".reg_empleado .btn_borrar").click(function(e){
        let codemp = $(this).closest(".reg_empleado").children(".codemp").text();
        let empleado = $(this).closest(".reg_empleado").children(".empleado").text();

        $("#md_borrar .lbl_codemp ").text(codemp);
        $("#md_borrar .lbl_empleado").text(empleado);

        $("#md_borrar .btn_borrar").attr("href","../../controlador/empleado/ctr_borrar_emp.php?cod_emp="+codemp);
        $("#md_borrar").modal("show");
    });

    /*$("#frm_consultar_emp #txt_codemp").focusout(function(e){
        e.preventDefault();

        let codemp = $(this).val();

        if (codemp != "") {
            $.ajax({
                url: "../../controlador/empleado/ctr_consultar_emp.php",
                type: "POST",
                data: {cod_emp: codemp},
                success: function(rpta) {
                    let rp = JSON.parse(rpta);
                    console.log("Respuesta:",rpta);

                    if(rp) {
                        $(".nombre").html(rp.nombre_empleado);
                        $(".apellido_mat").html(rp.apellido_materno);
                        $(".apellido_pat").html(rp.apellido_paterno);
                        $(".tipo_doc").html(rp.tipo_documento);
                        $(".nro_doc").html(rp.nro_documento );
                        $(".telefono").html(rp.telefono);
                        $(".email").html(rp.email);
                        $(".direccion").html(rp.direccion);
                        $(".sueldo").html(rp.sueldo);
                        $(".estado_sueldo").html(rp.estado_sueldo);
                        $(".fecha_contratacion").html(rp.fecha_contratacion);
                        $(".puesto").html(rp.puesto );
                        $(".area").html(rp.empleado_codigo_area);
                    } else {
                        alert("El codigo " +codemp+ "no existe");

                        $("#txt_codemp").val("");

                        let vacio = "&nbsp;";

                        $(".nombre").html(vacio);
                        $(".apellido_mat").html(vacio);
                        $(".apellido_pat").html(vacio);
                        $(".nro_doc").html(vacio);
                        $(".telefono").html(vacio);
                        $(".email").html(vacio);
                        $(".direccion").html(vacio);
                        $(".sueldo").html(vacio);
                        $(".estado_sueldo").html(vacio);
                        $(".fecha_contratacion").html(vacio);
                        $(".puesto").html(vacio);
                        $(".area").html(vacio);
                        $("#txt_codemp").focus();
                    }
                }
            });
        }
    });*/

    $("#frm_filtrar_emp #btn_filtrar").on("click", function(e){
        e.preventDefault();
        console.log("Botón de filtrar clicado");
        var valor=$("#txt_valor").val();
        console.log("Valor para filtrar: " + valor);

        if (valor!=""){
            $.post("../../controlador/empleado/ctr_filtrar_emp.php",
                {valor:valor},
                function(rpta){
                    console.log("Respuesta del servidor: ", rpta); 
                    $("#tabla").html(rpta);
                });
            }else{
                $("#tabla").html("");
                alert("Escriba un valor para filtrar...");
                $("#txt_valor").focus();
            }
    });

    $("#frm_consultar_emp #btn_buscar").click(function() {
        var codemp = $("#txt_codemp").val();

        if (codemp.trim() === "") {
            alert("Por favor, ingresa un código de área.");
            return;
        }

        $.ajax({
            url: '../../controlador/empleado/ctr_consultar_emp.php', 
            type: 'POST',
            data: { cod_emp: codemp },
            success: function(response) {
                var data = JSON.parse(response);
                
                if (data) {
                    $(".modal-nombre").text(data.nombre_empleado);
                    $(".modal-apellido_mat").text(data.apellido_materno ); 
                    $(".modal-apellido_pat").text(data.apellido_paterno);
                    $(".modal-tipo_doc").text(data.tipo_documento);
                    $(".modal-nro_doc").text(data.nro_documento); 
                    $(".modal-telefono").text(data.telefono);
                    $(".modal-email").text(data.email); 
                    $(".modal-direccion").text(data.direccion);
                    $(".modal-sueldo").text(data.sueldo); 
                    $(".modal-estado_sueldo").text(data.estado_sueldo);
                    $(".modal-fecha_contratacion").text(data.fecha_contratacion); 
                    $(".modal-puesto").text(data.puesto);
                    $(".modal-area").text(data.area );
                    $("#dataModal").modal('show');
                }
                else {
                    alert("Empleado no encontrada.");
                }
            },
            error: function() {
                alert("Hubo un error en la búsqueda.");
            }
        });
    });

})


//Funciones de Area
$(function(){
    $(".reg_area .btn_mostrar").click(function(e){
        let codarea = $(this).closest(".reg_area").children(".codarea").text();

        location.href = "mostrar_area.php?codarea="+codarea;
    });

    $(".reg_area .btn_editar").click(function(e){
        let codarea = $(this).closest(".reg_area").children(".codarea").text();

        location.href = "editar_area.php?codarea="+codarea;
    });

    $(".reg_area .btn_borrar").click(function(e){
        let cod_area = $(this).closest(".reg_area").children(".codarea").text();
        let area = $(this).closest(".reg_area").children(".area").text();

        $("#md_borrar .lbl_codarea ").text(cod_area);
        $("#md_borrar .lbl_area").text(area);

        $("#md_borrar .btn_borrar").attr("href","../../controlador/area/ctr_borrar_area.php?cod_area="+cod_area);
        $("#md_borrar").modal("show");
    });

    $("#frm_filtrar_area #btn_filtrar").on("click", function(e){
        e.preventDefault();
        console.log("Botón de filtrar clicado");
        var valor=$("#txt_valor").val();
        console.log("Valor para filtrar: " + valor);

        if (valor!=""){
            $.post("../../controlador/area/ctr_filtrar_area.php",
                {valor:valor},
                function(rpta){
                    console.log("Respuesta del servidor: ", rpta); 
                    $("#tabla").html(rpta);
                });
            }else{
                $("#tabla").html("");
                alert("Escriba un valor para filtrar...");
                $("#txt_valor").focus();
            }
    });

    $("#frm_consultar_area #btn_buscar").click(function() {
        var codarea = $("#txt_codarea").val();

        if (codarea.trim() === "") {
            alert("Por favor, ingresa un código de área.");
            return;
        }

        $.ajax({
            url: '../../controlador/area/ctr_consultar_area.php', 
            type: 'POST',
            data: { cod_area: codarea },
            success: function(response) {
                var data = JSON.parse(response);
                
                if (data) {
                    $(".modal-codarea").text(data.codigo_area);
                    $(".modal-area").text(data.area); 
                    $("#dataModal").modal('show');
                }
                else {
                    alert("Área no encontrada.");
                }
            },
            error: function() {
                alert("Hubo un error en la búsqueda.");
            }
        });
    });
})

//Funciones de Asignacion:
$(function() {
    $(".reg_asignacion .btn_mostrar").click(function(e){
        let codasi = $(this).closest(".reg_asignacion").children(".codasi").text();

        location.href = "mostrar_asignacion.php?codasi="+codasi;
    });

    $(".reg_asignacion .btn_editar").click(function(e){
        let codasi = $(this).closest(".reg_asignacion").children(".codasi").text();

        location.href = "editar_asignacion.php?codasi="+codasi
    });

    $(".reg_asignacion .btn_borrar").click(function(e){
        let codasi = $(this).closest(".reg_asignacion").children(".codasi").text();
        let asi = $(this).closest(".reg_asignacion").children(".rol").text();

        $("#md_borrar .lbl_codasi").text(codasi);
        $("#md_borrar .lbl_rol").text(asi);

        $("#md_borrar .btn_borrar").attr("href","../../controlador/asignacion/ctr_borrar_asi.php?cod_asi="+codasi);
        $("#md_borrar").modal("show");
    })

    $("#frm_consultar_asi #btn_buscar").click(function() {
        var codasi = $("#txt_codasi").val();

        if (codasi.trim() === "") {
            alert("Por favor, ingresa un código de área.");
            return;
        }

        $.ajax({
            url: '../../controlador/asignacion/ctr_consultar_asi.php', 
            type: 'POST',
            data: { cod_asi: codasi },
            success: function(response) {
                var data = JSON.parse(response);
                
                if (data) {
                    $(".modal-codasi").text(data.codigo_asignacion);
                    $(".modal-f_asi").text(data.fecha_asignacion); 
                    $(".modal-proy").text(data.proyecto); 
                    $(".modal-nombre_emp").text(data.nombre_empleado); 
                    $(".modal-rol").text(data.rol);
                    $(".modal-cliente").text(data.nombre_cliente);
                    $("#dataModal").modal('show');
                }
                else {
                    alert("Área no encontrada.");
                }
            },
            error: function() {
                alert("Hubo un error en la búsqueda.");
            }
        });
    });
    
    $("#frm_filtrar_asi #btn_filtrar").on("click", function(e){
        e.preventDefault();
        console.log("Botón de filtrar clicado");
        var valor=$("#txt_valor").val();
        console.log("Valor para filtrar: " + valor);

        if (valor!=""){
            $.post("../../controlador/asignacion/ctr_filtrar_asi.php",
                {valor:valor},
                function(rpta){
                    console.log("Respuesta del servidor: ", rpta); 
                    $("#tabla").html(rpta);
                });
            }else{
                $("#tabla").html("");
                alert("Escriba un valor para filtrar...");
                $("#txt_valor").focus();
            }
    });
})
