<?php
include_once 'conexion.php';
function obtenermesaspormateriaporcomision($codigomateria, $idcomision, $iddocente)
{
    $conexionbd = obtenerconexion();

    // 1. Obtener la última fecha de mesa de examen cargada en la base de datos
    $sql_max = "SELECT MAX(fecha_mesa) AS ultima_fecha FROM mesas_examen";
    $res_max = mysqli_query($conexionbd, $sql_max);
    $row_max = mysqli_fetch_assoc($res_max);
    
    // Si no hay mesas cargadas, establecemos un límite por defecto (ej. hoy) para evitar errores
    $fecha_fin = $row_max['ultima_fecha'] ?? date('Y-m-d'); 
    
    // La fecha de inicio es la de hoy
    $fecha_inicio = date('Y-m-d'); 

    // 2. Consulta principal: Filtrar las mesas entre hoy ($fecha_inicio) y la última fecha ($fecha_fin)
    $sql = "SELECT me.id_mesa, me.fecha_mesa, me.hora_examen, me.docente_titular, me.cod_materia, me.id_comision,
        d.nombre, d.apellido, c.comision, m.nombre_materia
        FROM mesas_examen AS me     
        INNER JOIN docentes AS d ON me.docente_titular = d.id_docente
        INNER JOIN comisiones AS c ON me.id_comision = c.id_comision
        INNER JOIN materias AS m ON me.cod_materia = m.cod_materia
        WHERE me.cod_materia = '$codigomateria'
            AND me.id_comision = $idcomision
            AND me.docente_titular = $iddocente
            -- FILTRO CLAVE: Mesas desde hoy hasta la última fecha cargada.
            AND me.fecha_mesa BETWEEN '$fecha_inicio' AND '$fecha_fin'
        ORDER BY me.fecha_mesa ASC"; // Opcional: ordenar para mejor visualización

    $resultado = mysqli_query($conexionbd, $sql);

    $mesasdeexamen = [];

    while ($fila = mysqli_fetch_assoc($resultado)){
        $mesasdeexamen[] = $fila;
    }

    return $mesasdeexamen;
}
function insertarmesadeexamen($fecha_mesa, $hora_examen, $docente_titular, $cod_materia, $id_comision, $priemra_vocal, $segunda_vocal)
{
    $conexionbd = obtenerconexion();

    // Sanitización y encapsulamiento de valores
    $fecha_mesa_sql = mysqli_real_escape_string($conexionbd, $fecha_mesa);
    $hora_examen_sql = mysqli_real_escape_string($conexionbd, $hora_examen);
    $docente_titular_sql = mysqli_real_escape_string($conexionbd, $docente_titular);
    $cod_materia_sql = mysqli_real_escape_string($conexionbd, $cod_materia);
    $id_comision_sql = mysqli_real_escape_string($conexionbd, $id_comision);
    
    // ATENCIÓN: Se usa 'priemra_vocal' como variable y como nombre de columna
    $priemra_vocal_sql = mysqli_real_escape_string($conexionbd, $priemra_vocal); 
    $segunda_vocal_sql = mysqli_real_escape_string($conexionbd, $segunda_vocal);

    $sql = "INSERT INTO mesas_examen (fecha_mesa, hora_examen, docente_titular, cod_materia, id_comision, priemra_vocal, segunda_vocal) 
            VALUES ('$fecha_mesa_sql', '$hora_examen_sql', '$docente_titular_sql', '$cod_materia_sql', '$id_comision_sql', '$priemra_vocal_sql', '$segunda_vocal_sql')";

    $resultado = mysqli_query($conexionbd, $sql);

    if($resultado === false){
        return false;
    }
    
    return true;
}
?>