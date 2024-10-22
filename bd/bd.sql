/* --------------------- CREACION DE LA BASE DE DATOS --------------------- */

-- Creacion de la Base de Datos "bd_jhardsystex"
create database bd_jhardsystex;

-- Usar la Base de Datos "bd_jhardsystex"
use bd_jhardsystex;


/* ------------------- CREACION DE 3 TABLAS FUERTES (PK) ------------------- */

-- Creacion de la 1ra tabla "tb_area"
 create table tb_area(
	codigo_area char(5) not null primary key,
    area varchar(50) not null,
    estado enum('ACTIVO', 'DESACTIVADO') not null); 

-- Creacion de la 2da tabla "tb_cliente" 
create table tb_cliente(
	codigo_cliente char(5) not null primary key,
    tipo_cliente enum('EMPRESA','ORGANIZACION','PERSONA') not null,
    nombre_cliente varchar(50) not null,
    tipo_documento enum('RUC','CARNET DE EXTRANJERIA','DNI') not null, 
    nro_documento varchar(20) not null, 
    telefono varchar(9) not null,
    email varchar(100) not null unique,
    direccion varchar(100) not null,
    estado enum('ACTIVO', 'DESACTIVADO') not null); 

-- Creacion de la tabla "tb_login" 
CREATE TABLE tb_login (
    codigo_usuario VARCHAR(5) PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    estado enum('ACTIVO', 'DESACTIVADO') not null);


/* ------------------- CREACION DE 3 TABLAS DEBILES (FK) -------------------*/

-- Creacion de la 3ra tabla "tb_empleado" 
create table tb_empleado(
	codigo_empleado char(5) not null primary key,
    nombre_empleado varchar(50) not null,
    apellido_materno varchar(50) not null,
    apellido_paterno varchar(50) not null,
    tipo_documento enum('DNI','PASAPORTE','CARNET DE EXTRANJERIA') not null, 
    nro_documento varchar(12) not null, 
    telefono varchar(9) not null,
    email varchar(100) not null unique,
    direccion varchar(100) not null,
    sueldo float not null, /* Agregado */
    estado_sueldo enum('PENDIENTE','PAGADO','CANCELADO','RETRASADO','PARCIAL','REVISION') not null, /* Agregado */
    fecha_contratacion date not null,
    puesto varchar(50) not null,
    estado enum('ACTIVO', 'DESACTIVADO') not null, 
    empleado_codigo_area char(5) not null, /* FK */
    foreign key (empleado_codigo_area) references tb_area(codigo_area)); /* FK de la 1ra tabla "tb_area" */

-- Creacion de la 4ta tabla "tb_proyecto" 
create table tb_proyecto(
	codigo_proyecto char(5) not null primary key,
    proyecto varchar(100) not null,
    descripcion varchar(200),
    fecha_inicio date,
    fecha_fin date,
    estado_proyecto varchar(20),
    precio float,
    estado enum('ACTIVO', 'DESACTIVADO') not null,
    proyecto_codigo_cliente char(5) not null, /* FK */
    foreign key (proyecto_codigo_cliente) references tb_cliente (codigo_cliente)); /* FK de la 2da tabla "tb_cliente" */

-- Creacion de la 5ta tabla "tb_asignacion"
create table tb_asignacion(
	codigo_asignacion char(5) not null primary key,
    fecha_asignacion date,
    rol varchar(50),
    estado enum('ACTIVO', 'DESACTIVADO')not null, 
    asignacion_codigo_empleado char(5) not null, /* FK */
    asignacion_codigo_proyecto char(5) not null, /* FK */
    foreign key (asignacion_codigo_empleado) references tb_empleado (codigo_empleado), /* FK de la 3ra tabla "tb_empleado" */
    foreign key (asignacion_codigo_proyecto) references tb_proyecto (codigo_proyecto)); /* FK de la 4ta tabla "tb_proyecto" */


/* ------------------- CREACION DE PROCEDIMIENTOS ALMACENADOS PARA AREA -------------------*/

-- AREA - LISTAR NORMAL
delimiter $$
create procedure sp_listar_area()
begin
	select *
    from tb_area
    where estado = 'ACTIVO'; 
end $$

-- AREA - BUSCAR POR CODIGO 
delimiter $$
create procedure sp_buscar_area_por_codigo(
	in cod_are char(5))
begin
	select *
    from tb_area
    where estado = 'ACTIVO' 
    AND (codigo_area = cod_are); 
end $$

-- AREA - MOSTRAR POR CODIGO / SIN MOSTRAR CODIGO
delimiter $$
create procedure sp_mostrar_area_por_codigo(
	in cod_are char(5))
begin
	select 	codigo_area,
			area
    from tb_area
    where estado = 'ACTIVO' 
    AND (codigo_area = cod_are); 
end $$

-- AREA - FILTRAR POR NOMBRE / SIN MOSTRAR CODIGO / PRIMERAS LETRAS
delimiter $$
create procedure sp_filtrar_por_area(
	in valor varchar(50))
begin
	select 	codigo_area,
			area
    from tb_area
    where estado = 'ACTIVO'
    AND area LIKE CONCAT(valor, '%'); 
end $$

-- AREA - REGISTRAR
delimiter $$
create procedure sp_registrar_area(
    /* Datos de Entrada */
    in cod_are char(5),
    in area varchar(50))
begin
    /* Caso si el "codigo_area" ya existe */
    if exists (select 1 from tb_area where codigo_area = cod_are) then signal sqlstate '45000'
            set message_text = 'El código del area ya existe.';
    else
		/* Caso si todo está bien, insertar area con estado ACTIVO por defecto */
		insert into tb_area (codigo_area, area, estado)
		values (cod_are, area, 'ACTIVO');
    end if;
end $$

-- AREA - EDITAR
delimiter $$
create procedure sp_editar_area(
    /* Datos de Entrada */
    in cod_are char(5),
    in area varchar(50))
begin
    /* Verificar si el area existe */
    if exists (select 1 from tb_area where codigo_area = cod_are and estado = 'ACTIVO') then
		/* Actualizar el nombre del area, manteniendo el estado actual */
		update tb_area
		set area = area
		where codigo_area = cod_are;
    else
        /* Error si el codigo_area no existe */
        signal sqlstate '45000' set message_text = 'El código del area no existe.';
    end if;
end $$

-- AREA - ELIMINAR
delimiter $$
create procedure sp_borrar_area(
    /* Datos de Entrada */
    in cod_are char(5))
begin
    /* Verificar si el area existe */
    if exists (select 1 from tb_area where codigo_area = cod_are) then
        /* Verificar si el estado ya está DESACTIVADO */
        if (select estado from tb_area where codigo_area = cod_are) = 'DESACTIVADO' then signal sqlstate '45000'
                set message_text = 'El area ya está desactivado.';
        else
            /* Cambiar el estado a DESACTIVADO */
            update tb_area
            set estado = 'DESACTIVADO'
            where codigo_area = cod_are;
        end if;
    else
        /* Error si el codigo_area no existe */
        signal sqlstate '45000' set message_text = 'El código del area no existe.';
    end if;
end $$


/* ------------------- CREACION DE PROCEDIMIENTOS ALMACENADOS PARA CLIENTE -------------------*/

-- CLIENTE - LISTAR NORMAL
delimiter $$
create procedure sp_listar_cliente()
begin
	select *
    from tb_cliente
    where estado = 'ACTIVO'; 
end $$

-- CLIENTE - BUSCAR POR CODIGO 
delimiter $$
create procedure sp_buscar_cliente_por_codigo(
	in cod_cli char(5))
begin
	select 	*
	from tb_cliente 
    where estado = 'ACTIVO'
    AND (codigo_cliente = cod_cli); 
end $$

-- CLIENTE - MOSTRAR POR CODIGO / SIN MOSTRAR CODIGO
delimiter $$
create procedure sp_mostrar_cliente_por_codigo(
	in cod_cli char(5))
begin
	select 	codigo_cliente,
			tipo_cliente,
			nombre_cliente,
            tipo_documento,
            nro_documento,
            telefono,
            email,
            direccion 
	from tb_cliente 
    where estado = 'ACTIVO'
    AND (codigo_cliente = cod_cli); 
end $$

-- CLIENTE - FILTRAR POR NOMBRE / SIN MOSTRAR CODIGO / PRIMERAS LETRAS
delimiter $$
create procedure sp_filtrar_por_cliente(
	in valor varchar(50))
begin
	select 	codigo_cliente,
			tipo_cliente,
			nombre_cliente,
            tipo_documento,
            nro_documento,
            telefono,
            email,
            direccion 
	from tb_cliente 
    where estado = 'ACTIVO'
    AND nombre_cliente LIKE CONCAT(valor, '%'); 
end $$

-- CLIENTE - REGISTRAR
delimiter $$
create procedure sp_registrar_cliente(
    /* Datos de Entrada */
    in cod_cli char(5),
    in tipo_cli enum('EMPRESA','ORGANIZACION','PERSONA'),
    in nombre_cli varchar(50),
    in tipo_doc enum('RUC','CARNET DE EXTRANJERIA','DNI'),
    in nro_doc varchar(20),
    in tlf varchar(9),
    in email_cli  varchar(100),
    in dir varchar(100))
begin
    /* Verificar si el "codigo_cliente" ya existe */
    if exists (select 1 from tb_cliente where codigo_cliente = cod_cli) then 
        signal sqlstate '45000' set message_text = 'El código del cliente ya existe.';
    /* Verificar si el "email" ya está registrado */
    elseif exists (select 1 from tb_cliente where email = email_cli ) then
        signal sqlstate '45000' set message_text = 'El email ya está registrado.';
    /* Verificar si el "nro_documento" ya está registrado */
    elseif exists (select 1 from tb_cliente where nro_documento = nro_doc) then
        signal sqlstate '45000' set message_text = 'El número de documento ya está registrado.';
    /* Verificar si el "telefono" ya está registrado */
    elseif exists (select 1 from tb_cliente where telefono = tlf) then
        signal sqlstate '45000' set message_text = 'El teléfono ya está registrado.';
    /* Verificar si el tipo de cliente es válido */
    elseif tipo_cli not in ('EMPRESA', 'ORGANIZACION', 'PERSONA') then
        signal sqlstate '45000' set message_text = 'El tipo de cliente debe ser EMPRESA, ORGANIZACION o PERSONA.';
    /* Verificar si el tipo de documento es válido */
    elseif tipo_doc not in ('RUC', 'CARNET DE EXTRANJERIA', 'DNI') then
        signal sqlstate '45000' set message_text = 'El tipo de documento debe ser RUC, CARNET DE EXTRANJERIA o DNI.';
    else
        /* Si todo está bien, insertar el cliente con estado ACTIVO */
        insert into tb_cliente (codigo_cliente, tipo_cliente, nombre_cliente, tipo_documento, nro_documento, telefono, email, direccion, estado)
        values (cod_cli, tipo_cli, nombre_cli, tipo_doc, nro_doc, tlf, email_cli , dir, 'ACTIVO');
    end if;
end $$

-- CLIENTE - EDITAR
delimiter $$
create procedure sp_editar_cliente(
    /* Datos de Entrada */
    in cod_cli char(5),
    in tipo_cli enum('EMPRESA','ORGANIZACION','PERSONA'),
    in nombre_cli varchar(50),
    in tipo_doc enum('RUC','CARNET DE EXTRANJERIA','DNI'),
    in nro_doc varchar(20),
    in tlf varchar(9),
    in email_cli  varchar(100),
    in dir varchar(100))
begin
    /* Verificar si el cliente existe */
    if not exists (select 1 from tb_cliente where codigo_cliente = cod_cli and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del cliente no existe.';
    /* Verificar si el email ya está registrado (excepto el del cliente que se está editando) */
    elseif exists (select 1 from tb_cliente where email = email_cli  and codigo_cliente != cod_cli) then
        signal sqlstate '45000' set message_text = 'El email ya está registrado.';
    /* Verificar si el nro_documento ya está registrado (excepto el del cliente que se está editando) */
    elseif exists (select 1 from tb_cliente where nro_documento = nro_doc and codigo_cliente != cod_cli) then
        signal sqlstate '45000' set message_text = 'El número de documento ya está registrado.';
    /* Verificar si el telefono ya está registrado (excepto el del cliente que se está editando) */
    elseif exists (select 1 from tb_cliente where telefono = tlf and codigo_cliente != cod_cli) then
        signal sqlstate '45000' set message_text = 'El teléfono ya está registrado.';
    /* Verificar si el tipo de cliente es válido */
    elseif tipo_cli not in ('EMPRESA', 'ORGANIZACION', 'PERSONA') then
        signal sqlstate '45000' set message_text = 'El tipo de cliente debe ser EMPRESA, ORGANIZACION o PERSONA.';
    /* Verificar si el tipo de documento es válido */
    elseif tipo_doc not in ('RUC', 'CARNET DE EXTRANJERIA', 'DNI') then
        signal sqlstate '45000' set message_text = 'El tipo de documento debe ser RUC, CARNET DE EXTRANJERIA o DNI.';
    else
        /* Actualizar los datos del cliente manteniendo el estado actual */
        update tb_cliente
        set tipo_cliente = tipo_cli,
            nombre_cliente = nombre_cli,
            tipo_documento = tipo_doc,
            nro_documento = nro_doc,
            telefono = tlf,
            email = email_cli,
            direccion = dir
        where codigo_cliente = cod_cli;
    end if;
end $$

-- CLIENTE - ELIMINAR
delimiter $$
create procedure sp_borrar_cliente(
    /* Datos de Entrada */
    in cod_cli char(5))
begin
    /* Verificar si el cliente existe */
    if not exists (select 1 from tb_cliente where codigo_cliente = cod_cli) then
        signal sqlstate '45000' set message_text = 'El código del cliente no existe.';
    /* Verificar si el cliente ya está desactivado */
    elseif (select estado from tb_cliente where codigo_cliente = cod_cli) = 'DESACTIVADO' then
        signal sqlstate '45000' set message_text = 'El cliente ya está desactivado.';
    else
        /* Cambiar el estado a DESACTIVADO */
        update tb_cliente
        set estado = 'DESACTIVADO'
        where codigo_cliente = cod_cli;
    end if;
end $$


/* ------------------- CREACION DE PROCEDIMIENTOS ALMACENADOS PARA EMPLEADO -------------------*/

-- EMPLEADO - LISTAR NORMAL
delimiter $$
create procedure sp_listar_empleado()
begin
	select *
    from tb_empleado
    where estado = 'ACTIVO'; 
end $$

-- EMPLEADO - BUSCAR POR CODIGO
delimiter $$
create procedure sp_buscar_empleado_por_codigo(
	in cod_emp char(5))
begin
	select *
    from tb_empleado
    where estado = 'ACTIVO'
    AND (codigo_empleado = cod_emp); 
end $$


-- EMPLEADO - MOSTRAR POR CODIGO / SIN MOSTRAR CODIGO
delimiter $$
create procedure sp_mostrar_empleado_por_codigo(
	in cod_emp char(5)) /* Modificacion */
begin
	select 	e.codigo_empleado,
			e.nombre_empleado,
			e.apellido_materno,
            e.apellido_paterno, 
            e.tipo_documento, 
            e.nro_documento, 
            e.telefono, 
            e.email, 
            e.direccion, 
            e.sueldo,
            e.estado_sueldo,
            e.fecha_contratacion, 
            e.puesto, 
            d.area
    from tb_empleado e 
    inner join tb_area d
    on e.empleado_codigo_area = d.codigo_area
    where e.estado = 'ACTIVO'
    AND (e.codigo_empleado = cod_emp); 
end $$

-- EMPLEADO - FILTRAR POR NOMBRE / SIN MOSTRAR CODIGO / PRIMERAS LETRAS
delimiter $$
create procedure sp_filtrar_por_empleado(
	in valor varchar(50)) /* Modificacion */
begin
	select 	e.codigo_empleado,
			e.nombre_empleado,
			e.apellido_materno,
            e.apellido_paterno, 
            e.tipo_documento, 
            e.nro_documento, 
            e.telefono, 
            e.email, 
            e.direccion, 
            e.sueldo,
            e.estado_sueldo,
            e.fecha_contratacion, 
            e.puesto, 
            d.area
    from tb_empleado e 
    inner join tb_area d
    on e.empleado_codigo_area = d.codigo_area
    where e.estado = 'ACTIVO'
    AND e.nombre_empleado LIKE CONCAT(valor, '%'); 
end $$

-- EMPLEADO - REGISTRAR
delimiter $$
create procedure sp_registrar_empleado(
    in cod_emp char(5),
    in nomb_emp varchar(50),
    in a_mat varchar(50),
    in a_pat varchar(50),
    in tipo_doc enum('DNI','PASAPORTE','CARNET DE EXTRANJERIA'),
    in nro_doc varchar(12),
    in tlf varchar(9),
    in email_emp varchar(100),
    in dir varchar(100),
    in sld float,
    in est_su enum('PENDIENTE','PAGADO','CANCELADO','RETRASADO','PARCIAL','REVISION'),
    in f_contra date,
    in puesto varchar(50),
    in cod_are char(5))
begin
    /* Verificar si el "codigo_empleado" ya existe */
    if exists (select 1 from tb_empleado where codigo_empleado = cod_emp) then 
        signal sqlstate '45000' set message_text = 'El código del empleado ya existe.';
    /* Verificar si el "email" ya está registrado */
    elseif exists (select 1 from tb_empleado where email = email_emp) then
        signal sqlstate '45000' set message_text = 'El email ya está registrado.';
    /* Verificar si el "nro_documento" ya está registrado */
    elseif exists (select 1 from tb_empleado where nro_documento = nro_doc) then
        signal sqlstate '45000' set message_text = 'El número de documento ya está registrado.';
    /* Verificar si el "telefono" ya está registrado */
    elseif exists (select 1 from tb_empleado where telefono = tlf) then
        signal sqlstate '45000' set message_text = 'El teléfono ya está registrado.';
    /* Verificar si el "tipo_documento" es válido */
    elseif tipo_doc not in ('DNI', 'PASAPORTE', 'CARNET DE EXTRANJERIA') then
        signal sqlstate '45000' set message_text = 'El tipo de documento debe ser DNI, PASAPORTE o CARNET DE EXTRANJERIA.';
	/* Verificar si el "estado_sueldo" es válido */
    elseif est_su not in ('PENDIENTE','PAGADO','CANCELADO','RETRASADO','PARCIAL','REVISION') then
        signal sqlstate '45000' set message_text = 'El estado del sueldo debe ser PENDIENTE, PAGADO, CANCELADO, RETRASADO, PARCIAL o REVISION.';
    /* Verificar si el area existe */
    elseif not exists (select 1 from tb_area where codigo_area = cod_are and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del area no existe.';
    else
        /* Insertar el empleado con estado ACTIVO */
        insert into tb_empleado (codigo_empleado, nombre_empleado, apellido_materno, apellido_paterno, tipo_documento, nro_documento, telefono, email, direccion, sueldo, estado_sueldo, fecha_contratacion, puesto, empleado_codigo_area, estado)
        values (cod_emp, nomb_emp, a_mat, a_pat, tipo_doc, nro_doc, tlf, email_emp, dir, sld, est_su, f_contra, puesto, cod_are, 'ACTIVO');
    end if;
end $$

-- EMPLEADO - EDITAR
delimiter $$
create procedure sp_editar_empleado(
    in cod_emp char(5),
    in nomb_emp varchar(50),
    in a_mat varchar(50),
    in a_pat varchar(50),
    in tipo_doc enum('DNI','PASAPORTE','CARNET DE EXTRANJERIA'),
    in nro_doc varchar(12),
    in tlf varchar(9),
    in email_emp varchar(100),
    in dir varchar(100),
    in sld float,
    in est_su enum('PENDIENTE','PAGADO','CANCELADO','RETRASADO','PARCIAL','REVISION'),
    in f_contra date,
    in puesto varchar(50),
    in cod_are char(5))
begin
    /* Verificar si el empleado existe */
    if not exists (select 1 from tb_empleado where codigo_empleado = cod_emp and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del empleado no existe.';
    /* Verificar si el email ya está registrado (excepto el del empleado que se está editando) */
    elseif exists (select 1 from tb_empleado where email = email_emp and codigo_empleado != cod_emp) then
        signal sqlstate '45000' set message_text = 'El email ya está registrado.';
    /* Verificar si el nro_documento ya está registrado (excepto el del empleado que se está editando) */
    elseif exists (select 1 from tb_empleado where nro_documento = nro_doc and codigo_empleado != cod_emp) then
        signal sqlstate '45000' set message_text = 'El número de documento ya está registrado.';
    /* Verificar si el telefono ya está registrado (excepto el del empleado que se está editando) */
    elseif exists (select 1 from tb_empleado where telefono = tlf and codigo_empleado != cod_emp) then
        signal sqlstate '45000' set message_text = 'El teléfono ya está registrado.';
    /* Verificar si el "tipo_documento" es válido */
    elseif tipo_doc not in ('DNI', 'PASAPORTE', 'CARNET DE EXTRANJERIA') then
        signal sqlstate '45000' set message_text = 'El tipo de documento debe ser DNI, PASAPORTE o CARNET DE EXTRANJERIA.';
	/* Verificar si el "estado_sueldo" es válido */
    elseif est_su not in ('PENDIENTE','PAGADO','CANCELADO','RETRASADO','PARCIAL','REVISION') then
        signal sqlstate '45000' set message_text = 'El estado del sueldo debe ser PENDIENTE, PAGADO, CANCELADO, RETRASADO, PARCIAL o REVISION.';
    /* Verificar si el area existe */
    elseif not exists (select 1 from tb_area where codigo_area = cod_are and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del area no existe.';
    else
        /* Actualizar los datos del empleado manteniendo el estado actual */
        update tb_empleado
        set nombre_empleado = nomb_emp,
            apellido_materno = a_mat,
            apellido_paterno = a_pat,
            tipo_documento = tipo_doc,
            nro_documento = nro_doc,
            telefono = tlf,
            email = email_emp,
            direccion = dir,
            sueldo = sld,
            estado_sueldo = est_su,
            fecha_contratacion = f_contra,
            puesto = puesto,
            empleado_codigo_area = cod_are
        where codigo_empleado = cod_emp;
    end if;
end $$

-- EMPLEADO - ELIMINAR
delimiter $$
create procedure sp_borrar_empleado(
    in cod_emp char(5))
begin
    /* Verificar si el empleado existe */
    if not exists (select 1 from tb_empleado where codigo_empleado = cod_emp) then
        signal sqlstate '45000' set message_text = 'El código del empleado no existe.';
    /* Verificar si el empleado ya está desactivado */
    elseif (select estado from tb_empleado where codigo_empleado = cod_emp) = 'DESACTIVADO' then
        signal sqlstate '45000' set message_text = 'El empleado ya está desactivado.';
    else
        /* Cambiar el estado a DESACTIVADO */
        update tb_empleado
        set estado = 'DESACTIVADO'
        where codigo_empleado = cod_emp;
    end if;
end $$


/* ------------------- CREACION DE PROCEDIMIENTOS ALMACENADOS PARA PROYECTO -------------------*/

-- PROYECTO - LISTAR NORMAL
delimiter $$
create procedure sp_listar_proyecto()
begin
	select *
    from tb_proyecto
    where estado = 'ACTIVO'; 
end $$

-- PROYECTO - BUSCAR POR CODIGO 
delimiter $$
create procedure sp_buscar_proyecto_por_codigo(
	in cod_proy char(5))
begin
	select *
    from tb_proyecto
    where estado = 'ACTIVO'
    AND (codigo_proyecto = cod_proy); 
end $$

-- PROYECTO - MOSTRAR POR CODIGO / SIN MOSTRAR CODIGO
delimiter $$
create procedure sp_mostrar_proyecto_por_codigo(
	in cod_proy char(5)) /* Modificacion */ 
begin
	select 	p.codigo_proyecto,
			p.proyecto,
			p.descripcion,
            p.fecha_inicio,
            p.fecha_fin,
            p.estado_proyecto,
            p.precio,
            c.tipo_cliente,
            c.nombre_cliente
	from tb_proyecto p
    inner join tb_cliente c
    on p.proyecto_codigo_cliente = c.codigo_cliente
    where p.estado = 'ACTIVO'
    AND (p.codigo_proyecto = cod_proy); 
end $$

-- PROYECTO - FILTRAR POR NOMBRE / SIN MOSTRAR CODIGO / PRIMERAS LETRAS
delimiter $$
create procedure sp_filtrar_por_proyecto(
	in valor varchar(50)) /* Modificacion */ 
begin
	select 	p.codigo_proyecto,
			p.proyecto,
			p.descripcion,
            p.fecha_inicio,
            p.fecha_fin,
            p.estado_proyecto,
            p.precio,
            c.tipo_cliente,
            c.nombre_cliente
	from tb_proyecto p
    inner join tb_cliente c
    on p.proyecto_codigo_cliente = c.codigo_cliente
    where p.estado = 'ACTIVO'
    AND p.proyecto LIKE CONCAT(valor, '%'); 
end $$

-- PROYECTO - REGISTRAR
delimiter $$
create procedure sp_registrar_proyecto(
    in cod_proy char(5),
    in proy varchar(100),
    in descr varchar(200),
    in f_ini date,
    in f_fin date,
    in es_proy varchar(20),
    in precio float,
    in cod_cli char(5))
begin
    /* Verificar si el código del proyecto ya existe */
    if exists (select 1 from tb_proyecto where codigo_proyecto = cod_proy) then
        signal sqlstate '45000' set message_text = 'El código del proyecto ya existe.';
    /* Verificar si el cliente existe */
    elseif not exists (select 1 from tb_cliente where codigo_cliente = cod_cli and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El cliente no existe.';
    else
        /* Si todo está bien, insertar el proyecto con estado ACTIVO */
        insert into tb_proyecto (codigo_proyecto, proyecto, descripcion, fecha_inicio, fecha_fin, estado_proyecto, precio, estado, proyecto_codigo_cliente)
        values (cod_proy, proy, descr, f_ini, f_fin, es_proy, precio, 'ACTIVO', cod_cli);
    end if;
end $$

-- PROYECTO - EDITAR
delimiter $$
create procedure sp_editar_proyecto(
    in cod_proy char(5),
    in proy varchar(100),
    in descr varchar(200),
    in f_ini date,
    in f_fin date,
    in es_proy varchar(20),
    in precio float,
    in cod_cli char(5))
begin
    /* Verificar si el proyecto existe */
    if not exists (select 1 from tb_proyecto where codigo_proyecto = cod_proy and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del proyecto no existe.';
    /* Verificar si el cliente existe */
    elseif not exists (select 1 from tb_cliente where codigo_cliente = cod_cli and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El cliente no existe.';
    else
        /* Actualizar los datos del proyecto manteniendo el estado actual */
        update tb_proyecto
        set proyecto = proy,
            descripcion = descr,
            fecha_inicio = f_ini,
            fecha_fin = f_fin,
            estado_proyecto = es_proy,
            precio = precio,
            proyecto_codigo_cliente = cod_cli
        where codigo_proyecto = cod_proy;
    end if;
end $$

-- PROYECTO - ELIMINAR
delimiter $$
create procedure sp_borrar_proyecto(
    in cod_proy char(5))
begin
    /* Verificar si el proyecto existe */
    if not exists (select 1 from tb_proyecto where codigo_proyecto = cod_proy) then
        signal sqlstate '45000' set message_text = 'El código del proyecto no existe.';
    /* Verificar si el proyecto ya está desactivado */
    elseif (select estado from tb_proyecto where codigo_proyecto = cod_proy) = 'DESACTIVADO' then
        signal sqlstate '45000' set message_text = 'El proyecto ya está desactivado.';
    else
        /* Cambiar el estado a DESACTIVADO */
        update tb_proyecto
        set estado = 'DESACTIVADO'
        where codigo_proyecto = cod_proy;
    end if;
end $$


/* ------------------- CREACION DE PROCEDIMIENTOS ALMACENADOS PARA ASIGNACION -------------------*/

-- ASIGNACION - LISTAR NORMAL
delimiter $$
create procedure sp_listar_asignacion()
begin
	select *
    from tb_asignacion
    where estado = 'ACTIVO'; 
end $$

-- ASIGNACION - BUSCAR POR CODIGO 
delimiter $$
create procedure sp_buscar_asignacion_por_codigo(
	in cod_asi char(5))
begin
	select *
    from tb_asignacion
    where estado = 'ACTIVO'
    AND (codigo_asignacion = cod_asi);
end $$

-- ASIGNACION - MOSTRAR POR CODIGO / SIN MOSTRAR CODIGO
delimiter $$
create procedure sp_mostrar_asignacion_por_codigo(
	in cod_asi char(5)) /* Modificacion */
begin
	select 	a.codigo_asignacion,
			a.fecha_asignacion,
			a.rol,
            p.proyecto,
            p.estado_proyecto,
            c.tipo_cliente,
            c.nombre_cliente,
            e.nombre_empleado,
            e.puesto,
            d.area
    from tb_asignacion a
    inner join tb_proyecto p 
    on a.asignacion_codigo_proyecto = p.codigo_proyecto
    inner join tb_cliente c
    on p.proyecto_codigo_cliente = c.codigo_cliente
    inner join tb_empleado e
    on a.asignacion_codigo_empleado = e.codigo_empleado
    inner join tb_area d
    on e.empleado_codigo_area = d.codigo_area
    where a.estado = 'ACTIVO'
    AND (a.codigo_asignacion = cod_asi); /* Modificacion */
end $$

-- ASIGNACION - FILTRAR POR NOMBRE / SIN MOSTRAR CODIGO / PRIMERAS LETRAS
delimiter $$
create procedure sp_filtrar_por_asignacion(
	in valor varchar(50)) /* Modificacion */
begin
	select 	a.codigo_asignacion,
			a.fecha_asignacion,
			a.rol,
            p.proyecto,
            p.estado_proyecto,
            c.tipo_cliente,
            c.nombre_cliente,
            e.nombre_empleado,
            e.puesto,
            d.area
    from tb_asignacion a
    inner join tb_proyecto p 
    on a.asignacion_codigo_proyecto = p.codigo_proyecto
    inner join tb_cliente c
    on p.proyecto_codigo_cliente = c.codigo_cliente
    inner join tb_empleado e
    on a.asignacion_codigo_empleado = e.codigo_empleado
    inner join tb_area d
    on e.empleado_codigo_area = d.codigo_area
    where a.estado = 'ACTIVO'
    AND a.rol LIKE CONCAT(valor, '%'); 
end $$

-- ASIGNACION - REGISTRAR
delimiter $$
create procedure sp_registrar_asignacion(
    in cod_asi char(5),
    in f_asi date,
    in rol varchar(50),
    in cod_emp char(5),
    in cod_pro char(5)
)
begin
    /* Verificar si el "codigo_asignacion" ya existe */
    if exists (select 1 from tb_asignacion where codigo_asignacion = cod_asi) then
        signal sqlstate '45000' set message_text = 'El código de la asignación ya existe.';
    
    /* Verificar si el "codigo_empleado" existe en tb_empleado */
    elseif not exists (select 1 from tb_empleado where codigo_empleado = cod_emp and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del empleado no existe.';
    
    /* Verificar si el "codigo_proyecto" existe en tb_proyecto */
    elseif not exists (select 1 from tb_proyecto where codigo_proyecto = cod_pro and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del proyecto no existe.';
    
    else
        /* Insertar la nueva asignación con estado "ACTIVO" */
        insert into tb_asignacion (codigo_asignacion, fecha_asignacion, rol, estado, asignacion_codigo_empleado, asignacion_codigo_proyecto)
        values (cod_asi, f_asi, rol, 'ACTIVO', cod_emp, cod_pro);
    end if;
end $$

-- ASIGNACION - EDITAR
delimiter $$
create procedure sp_editar_asignacion(
    in cod_asi char(5),
    in f_asi date,
    in rol varchar(50),
    in cod_emp char(5),
    in cod_pro char(5)
)
begin
    /* Verificar si la asignación existe */
    if not exists (select 1 from tb_asignacion where codigo_asignacion = cod_asi and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código de la asignación no existe.';
    
    /* Verificar si el "codigo_empleado" existe en tb_empleado */
    elseif not exists (select 1 from tb_empleado where codigo_empleado = cod_emp and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del empleado no existe.';
    
    /* Verificar si el "codigo_proyecto" existe en tb_proyecto */
    elseif not exists (select 1 from tb_proyecto where codigo_proyecto = cod_pro and estado = 'ACTIVO') then
        signal sqlstate '45000' set message_text = 'El código del proyecto no existe.';
    
    else
        /* Actualizar la asignación manteniendo el estado actual */
        update tb_asignacion
        set fecha_asignacion = f_asi,
            rol = rol,
            asignacion_codigo_empleado = cod_emp,
            asignacion_codigo_proyecto = cod_pro
        where codigo_asignacion = cod_asi;
    end if;
end $$

-- ASIGNACION - ELIMINAR
delimiter $$
create procedure sp_borrar_asignacion(
    in cod_asi char(5)
)
begin
    /* Verificar si la asignación existe */
    if not exists (select 1 from tb_asignacion where codigo_asignacion = cod_asi) then
        signal sqlstate '45000' set message_text = 'El código de la asignación no existe.';
    
    /* Verificar si la asignación ya está desactivada */
    elseif (select estado from tb_asignacion where codigo_asignacion = cod_asi) = 'DESACTIVADO' then
        signal sqlstate '45000' set message_text = 'La asignación ya está desactivada.';
    
    else
        /* Desactivar la asignación */
        update tb_asignacion
        set estado = 'DESACTIVADO'
        where codigo_asignacion = cod_asi;
    end if;
end $$



/* ------------------------------------- INSERCION DE DATOS -------------------------------------*/

-- AREA
insert into tb_area (codigo_area, area) values
('A0001', 'Sistemas'), /* Modificacion */
('A0002', 'Marketing'), /* Modificacion */
('A0003', 'Diseño'), /* Modificacion */
('A0004', 'Ciberseguridad'), /* Modificacion */
('A0005', 'Soporte Técnico'), /* Modificacion */
('A0006', 'Recursos Humanos' ), /* Modificacion */
('A0007', 'Comunicaciones' ), /* Modificacion */
('A0008', 'Finanzas y logística'), /* Modificacion */
('A0009', 'Operaciones'), /* Modificacion */
('A0010', 'Legal'), /* Modificacion */
('A0011', 'Administración'); /* Modificacion */

-- CLIENTES
INSERT INTO tb_cliente (codigo_cliente, tipo_cliente, nombre_cliente, tipo_documento, nro_documento, telefono, email, direccion)
VALUES
('C0001', 'EMPRESA', 'Tech Solutions', 'RUC', '20000000001', '987654321', 'info@techsolutions.com', 'Av. Principal 123'), /* Modificacion */
('C0002', 'PERSONA', 'Fernando Ramos', 'CARNET DE EXTRANJERIA', 'PE1485323', '987654322', 'fernando.ramos@gmail.com', 'Calle Secundaria 456'), /* Modificacion */
('C0003', 'ORGANIZACION', 'MarketPro', 'RUC', '20000000002', '987654323', 'contacto@marketpro.com', 'Av. Tercera 789'), /* Modificacion */
('C0004', 'EMPRESA', 'SecuSafe', 'RUC', '20000000003', '987654324', 'seguridad@secusafe.com', 'Calle Cuarta 101'), /* Modificacion */
('C0005', 'PERSONA', 'Carlos Díaz', 'DNI', '83925523', '987654325', 'carlos.diaz@gmail.com', 'Av. Quinta 202'), /* Modificacion */
('C0006', 'ORGANIZACION', 'InnovaTech', 'RUC', '20000000004', '987654326', 'info@innovatech.com', 'Av. Sexta 303'), /* Modificacion */
('C0007', 'PERSONA', 'DesignLab', 'CARNET DE EXTRANJERIA', 'PE7341234', '987654327', 'contacto@designlab.com', 'Calle Séptima 404'), /* Modificacion */
('C0008', 'EMPRESA', 'BizConsult', 'RUC', '20000000005', '987654328', 'consultas@bizconsult.com', 'Av. Octava 505'), /* Modificacion */
('C0009', 'ORGANIZACION', 'WebSolutions', 'RUC', '20000000006', '987654329', 'info@websolutions.com', 'Calle Novena 606'), /* Modificacion */
('C0010', 'PERSONA', 'Laura Gómez', 'DNI', '72849532', '987654330', 'laura.gomez@gmail.com', 'Av. Décima 707'); /* Modificacion */

-- EMPLEADOS
INSERT INTO tb_empleado (codigo_empleado, nombre_empleado, apellido_materno, apellido_paterno, tipo_documento, nro_documento, telefono, email, direccion, sueldo, estado_sueldo, fecha_contratacion, puesto, empleado_codigo_area)
VALUES
('E0001', 'Ana', 'Pérez', 'Gómez', 'DNI', '42345678', '999999999', 'ana.perez@gmail.com', 'Av. Libertad 101', 2500.00, 'PAGADO', '2022-01-10', 'Desarrollador Front', 'A0001'),
('E0002', 'Luis', 'Rodríguez', 'López', 'CARNET DE EXTRANJERIA', 'PE2342783', '988888888', 'luis.rodriguez@gmail.com', 'Calle del Sol 202', 2600.00, 'PAGADO', '2021-06-15', 'Desarrollador Back', 'A0001'),
('E0003', 'María', 'Fernández', 'Martínez', 'PASAPORTE', 'A1234567', '977777777', 'maria.fernandez@gmail.com', 'Boulevard de las Naciones 303', 2800.00, 'PAGADO', '2022-03-20', 'Fullstack Developer', 'A0001'),
('E0004', 'Carlos', 'García', 'Mendoza', 'DNI', '78901234', '966666666', 'carlos.garcia@gmail.com', 'Calle 5 de Febrero 404', 2400.00, 'PAGADO', '2020-11-01', 'Técnico de Soporte y Mantenimiento', 'A0005'),
('E0005', 'Laura', 'Morales', 'Alvarez', 'CARNET DE EXTRANJERIA', 'PE5678901', '955555555', 'laura.morales@gmail.com', 'Av. del Mar 505', 2700.00, 'PAGADO', '2022-05-10', 'Diseñador Gráfico', 'A0003'),
('E0006', 'Jorge', 'Jiménez', 'Suárez', 'DNI', '12345678', '944444444', 'jorge.jimenez@gmail.com', 'Plaza Central 606', 2500.00, 'PAGADO', '2021-07-25', 'Desarrollador Front', 'A0001'),
('E0007', 'Sandra', 'Sánchez', 'Cordero', 'PASAPORTE', 'B8901234', '933333333', 'sandra.sanchez@gmail.com', 'Calle de la Primavera 707', 2400.00, 'PAGADO', '2022-04-18', 'Especialista en Marketing Digital', 'A0002'),
('E0008', 'Andrés', 'Martín', 'Hernández', 'DNI', '19587657', '922222222', 'andres.martin@gmail.com', 'Av. del Río 808', 2600.00, 'PAGADO', '2020-09-09', 'Fullstack Developer', 'A0001'),
('E0009', 'Elena', 'Gómez', 'Moreno', 'CARNET DE EXTRANJERIA', 'PE8901234', '911111111', 'elena.gomez@gmail.com', 'Calle de los Pinos 909', 2500.00, 'PAGADO', '2022-02-14', 'Analista de Operaciones', 'A0009'),
('E0010', 'Pedro', 'Vargas', 'Ríos', 'DNI', '74091902', '912380000', 'pedro.vargas@gmail.com', 'Calle de la Alegría 1010', 2700.00, 'PAGADO', '2023-01-01', 'Desarrollador Front', 'A0001'),
('E0011', 'Patricia', 'Paredes', 'Jiménez', 'DNI', '11737536', '966555444', 'patricia.paredes@gmail.com', 'Av. de los Cedros 1111', 2500.00, 'PAGADO', '2023-02-01', 'Desarrollador Back', 'A0001'),
('E0012', 'Ricardo', 'Reyes', 'Campos', 'PASAPORTE', 'C5678901', '977444333', 'ricardo.reyes@gmail.com', 'Plaza de la Cultura 1212', 2800.00, 'PAGADO', '2023-03-01', 'Fullstack Developer', 'A0001'),
('E0013', 'Gabriela', 'Soto', 'Bermúdez', 'DNI', '60340781', '988555222', 'gabriela.soto@gmail.com', 'Calle de la Innovación 1313', 2300.00, 'PAGADO', '2023-04-01', 'Diseñador UX/UI', 'A0003'),
('E0014', 'Fernando', 'Méndez', 'Vázquez', 'DNI', '52728258', '999444111', 'fernando.mendez@gmail.com', 'Av. de la Ciencia 1414', 2600.00, 'PAGADO', '2023-05-01', 'Analista de BD', 'A0001'),
('E0015', 'Jazmín', 'Castro', 'Martínez', 'PASAPORTE', 'F1234567', '966777888', 'jazmin.castro@gmail.com', 'Calle Girasoles 1515', 2400.00, 'PAGADO', '2023-06-01', 'Especialista en Recursos Humanos', 'A0006'),
('E0016', 'Oscar', 'Benítez', 'Fuentes', 'DNI', '26886412', '555888999', 'oscar.benitez@gmail.com', 'Jr. Las Amazonas 1616', 2500.00, 'PAGADO', '2023-07-01', 'Coordinador de Logística', 'A0008'),
('E0017', 'Marta', 'Gómez', 'León', 'DNI', '40626734', '444555666', 'marta.gomez@gmail.com', 'Calle Los Lirios 1717', 2600.00, 'PAGADO', '2023-08-01', 'Gestor de Comunicaciones', 'A0007'),
('E0018', 'Santiago', 'Morales', 'Alonso', 'DNI', '99296800', '333666777', 'santiago.morales@gmail.com', 'Calle Los Tulipanes 1818', 2800.00, 'PAGADO', '2023-09-01', 'Asesor Legal', 'A0010'),
('E0019', 'Isabel', 'Ríos', 'Valdés', 'CARNET DE EXTRANJERIA', 'PE1234567', '222777888', 'isabel.rios@gmail.com', 'Calle Las Manzanas 1919', 2300.00, 'PAGADO', '2023-10-01', 'Analista de Operaciones', 'A0009'),
('E0020', 'Martín', 'Salazar', 'Rivas', 'DNI', '7814094', '111888999', 'martin.salazar@gmail.com', 'Calle Las Peras 2020', 2500.00, 'PAGADO', '2023-11-01', 'Administrador de Oficina', 'A0011'),
('E0021', 'Roberto', 'Mora', 'Torres', 'PASAPORTE', 'B2572462', '999666555', 'roberto.mora@gmail.com', 'Calle Las Azucenas 2121', 2800.00, 'PAGADO', '2023-12-01', 'Especialista en Seguridad de la Información', 'A0004'),
('E0022', 'Camila', 'Solano', 'Torres', 'DNI', '56891648', '988555222', 'camila45@gmail.com', 'Jr. Tungasuca 2222', 2400.00, 'PAGADO', '2023-05-01', 'Diseñador UX/UI', 'A0003');

-- PROYECTOS
INSERT INTO tb_proyecto (codigo_proyecto, proyecto, descripcion, fecha_inicio, fecha_fin, estado_proyecto, precio, proyecto_codigo_cliente)
VALUES
('P0001', 'Desarrollo Web Corporativo', 'Desarrollo de un sitio web para Tech Solutions', '2024-01-01', '2025-01-01', 'En curso', 5000.00, 'C0001'), /* Modificacion */
('P0002', 'Estrategia SEO para MarketPro', 'Optimización para motores de búsqueda y marketing en buscadores para MarketPro', '2024-01-01', '2024-12-31', 'En curso', 2000.00, 'C0003'), /* Modificacion */
('P0003', 'Rediseño de UI/UX para SecuSafe', 'Rediseño de la interfaz de usuario y experiencia de usuario para SecuSafe', '2024-09-19', '2024-10-02', 'En curso', 3000.00, 'C0004'), /* Modificacion */
('P0004', 'Auditoría de Seguridad para InnovaTech', 'Evaluación de la seguridad de sistemas y datos para InnovaTech', '2024-01-01', '2024-10-02', 'En curso', 2500.00, 'C0006'), /* Modificacion */
('P0005', 'Desarrollo de Plataforma de E-commerce para BizConsult', 'Desarrollo de una plataforma de comercio electrónico para BizConsult', '2024-01-01', '2025-05-01', 'En curso', 7000.00, 'C0008'), /* Modificacion */
('P0006', 'Mantenimiento de PC para DesignLab', 'Mantenimiento y reparación de computadoras para DesignLab', '2024-01-01', '2024-12-01', 'En curso', 1500.00, 'C0007'), /* Modificacion */
('P0007', 'Consultoría Legal para WebSolutions', 'Asesoramiento legal para WebSolutions', '2024-01-01', '2024-12-31', 'En curso', 1800.00, 'C0009'), /* Modificacion */
('P0008', 'Portafolio para Fernando Ramos', 'Desarrollo de una página personal para Fernando Ramos', '2024-09-19', '2024-10-01', 'En curso', 4000.00, 'C0002'), /* Modificacion */
('P0009', 'Diseño de Identidad Corporativa para Laura Gómez', 'Creación de la identidad visual de una empresa para Laura Gómez', '2024-01-01', '2024-11-30', 'En curso', 2200.00, 'C0010'), /* Modificacion */
('P0010', 'Instalación de Cámaras de Seguridad para Carlos Díaz', 'Instalación y configuración de sistemas de cámaras de seguridad para Carlos Díaz', '2024-01-01', '2024-12-01', 'En curso', 1300.00, 'C0005'), /* Modificacion */
('P0011', 'Desarrollo Móvil para MarketPro', 'Desarrollo de una tienda online para MarketPro', '2023-10-12', '2024-05-01', 'Finalizado', 4500.00, 'C0003'); /* Modificacion */


-- ASIGNACION
INSERT INTO tb_asignacion (codigo_asignacion, fecha_asignacion, rol, asignacion_codigo_empleado, asignacion_codigo_proyecto)
VALUES
('AS001', '2024-01-02', 'Desarrollador Front', 'E0001', 'P0001'), /* Modificacion */
('AS002', '2024-01-02', 'Desarrollador Back', 'E0002', 'P0001'), /* Modificacion */
('AS003', '2024-01-02', 'Diseñador UX/UI', 'E0013', 'P0001'), /* Modificacion */
('AS004', '2024-01-02', 'Especialista en Marketing Digital', 'E0007', 'P0002'), /* Modificacion */
('AS005', '2024-09-19', 'Diseñador web', 'E0022', 'P0003'), /* Modificacion */
('AS006', '2024-01-01', 'Analista de Seguridad', 'E0014', 'P0004'), /* Modificacion */
('AS007', '2024-01-01', 'Desarrollador Front', 'E0006', 'P0005'), /* Modificacion */
('AS008', '2024-01-01', 'Desarrollador Back', 'E0003', 'P0005'), /* Modificacion */
('AS009', '2024-01-01', 'Diseñador UX/UI', 'E0013', 'P0005'), /* Modificacion */
('AS010', '2024-01-01', 'Técnico de Soporte y Mantenimiento', 'E0004', 'P0006'), /* Modificacion */
('AS011', '2024-01-01', 'Consultor Legal', 'E0018', 'P0007'), /* Modificacion */
('AS012', '2024-09-19', 'Desarrollador Front', 'E0008', 'P0008'), /* Modificacion */
('AS013', '2024-01-01', 'Diseñador Gráfico', 'E0005', 'P0009'), /* Modificacion */
('AS014', '2024-01-01', 'Técnico de Soporte y Mantenimiento', 'E0004', 'P0010'), /* Modificacion */
('AS015', '2023-10-12', 'Desarrollador Front', 'E0001', 'P0011'), /* Modificacion */
('AS016', '2023-10-12', 'Desarrollador Back', 'E0008', 'P0011'), /* Modificacion */
('AS017', '2023-10-12', 'Diseñador UX/UI', 'E0022', 'P0011'); /* Modificacion */

-- Insertar el primer registro con el usuario admin y la contraseña cifrada.
INSERT INTO tb_login (codigo_usuario, usuario, pass, estado)
VALUES ('L0001', 'admin', md5('admin'), 'ACTIVO');  -- Cifra la contraseña '1234'

/* ------------------------------------- COMANDOS RAPIDOS -------------------------------------*/

/* VISUALIZAR REGISTROS DE TABLAS */
select * from tb_area;
select * from tb_cliente;
select * from tb_empleado;
select * from tb_proyecto;
select * from tb_asignacion;
select * from tb_login;

/* VERIFICAR EL LOGIN */
-- CALL sp_listar_usuario();
-- CALL sp_autenticar_usuario('admin', '1234');


/* VISUALIZAR REGISTROS CON PROCEDIMIENTOS ALMACENADOS */
-- call sp_listar_area;
-- call sp_buscar_area_por_codigo("A0001");
-- call sp_filtrar_por_area("R");
-- call sp_mostrar_area_por_codigo("A0001");
-- call sp_registrar_area('A0005', 'Desarrollo');
-- call sp_editar_area('A0005', 'Marketing');
-- call sp_borrar_area('A0005');



-- call sp_listar_cliente;
-- call sp_buscar_cliente_por_codigo ("C0001");
-- call sp_filtrar_por_cliente("T");
-- call sp_mostrar_cliente_por_codigo("C0005");
-- call sp_registrar_cliente('C0005', 'PERSONA', 'Jose Nuñez', 'DNI', '12345676', '987658521', 'jose@gmail.com', '123 Main St');
-- call sp_editar_cliente('C0005', 'PERSONA', 'Julio Pérez', 'DNI', '12345676', '987654389', 'juanperez@example.com', '123 Main St');
-- call sp_borrar_cliente('C0005');



-- call sp_listar_empleado;
-- call sp_buscar_empleado_por_codigo ("E0001");
-- call sp_filtrar_por_empleado("C");
-- call sp_mostrar_empleado_por_codigo("E0001");
-- call sp_registrar_empleado('E0005', 'Juan', 'Pérez', 'González', 'DNI', '12345878', '987657321', 'juan@example.com', 'Av. Principal 123', 1500.50, 'PENDIENTE', '2024-01-15', 'Desarrollador', 'A0002');
-- call sp_editar_empleado('E0005', 'Juana', 'Pérez', 'González', 'DNI', '12345878', '987657321', 'juan@example.com', 'Av. Principal 123', 1500.50, 'PENDIENTE', '2024-01-15', 'Desarrollador', 'A0002');
-- call sp_borrar_empleado('E0005'); 



-- call sp_listar_proyecto;
-- call sp_buscar_proyecto_por_codigo ("P0001");
-- call sp_filtrar_por_proyecto("I");
-- call sp_mostrar_proyecto_por_codigo("P0001");
-- call sp_registrar_proyecto('P0005', 'Nuevo Proyecto', 'Descripción del nuevo proyecto', '2024-01-01', '2024-12-31', 'EN PROGRESO', 10000.00, 'C0001');
-- call sp_editar_proyecto('P0005', 'Nuevo Tech', 'Descripción del nuevo proyecto', '2024-01-01', '2024-12-31', 'EN PROGRESO', 10000.00, 'C0001');
-- call sp_borrar_proyecto('P0005');



-- call sp_listar_asignacion;
-- call sp_buscar_asignacion_por_codigo("AS001");
-- call sp_filtrar_por_asignacion("L");
-- call sp_mostrar_asignacion_por_codigo("AS001");
-- call sp_registrar_asignacion('AS005', '2024-01-01', 'Desarrollador', 'E0001', 'P0001');
-- call sp_editar_asignacion('AS005', '2024-01-01', 'Desarrolladora', 'E0001', 'P0001');
-- call sp_borrar_asignacion('AS005');




/* VISUALIZAR CONTENIDO DE TABLAS */
-- describe tb_area;
-- describe tb_cliente;
-- describe tb_empleado;
-- describe tb_proyecto;
-- describe tb_asignacion;
