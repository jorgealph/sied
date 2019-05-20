<html>

<head>
  
</head>

<body>
<div class="card bg-light" name="capturar" id="capturar">
<div class="container">
<div class="col-md-12"> <br>

    <?php echo form_open_multipart('');?>

    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Usuario', 'usuario');

        $input = array(
            'name' => 'usuario',
            'value' => $usuario,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

    <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Titulo', 'titulo');

        $input = array(
            'name' => 'titulo',
            'value' => $titulo,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Nombre', 'nombre');

        $input = array(
            'name' => 'nombre',
            'value' => $nombre,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div></div>

    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Paterno', 'paterno');

        $input = array(
            'name' => 'paterno',
            'value' => $paterno,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Materno', 'materno');

        $input = array(
            'name' => 'materno',
            'value' => $materno,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Correo1', 'correo1');

        $input = array(
            'name' => 'correo1',
            'value' => $correo1,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div></div>

    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Correo2', 'correo2');

        $input = array(
            'name' => 'correo2',
            'value' => $correo2,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Telefono', 'telefono');

        $input = array(
            'name' => 'telefono',
            'value' => $telefono,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Cargo', 'cargo');

        $input = array(
            'name' => 'cargo',
            'value' => $cargo,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div></div>

    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Celular', 'celular');

        $input = array(
            'name' => 'celular',
            'value' => $celular,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Organismo', 'organismo');

        $input = array(
            'name' => 'celular',
            'value' => $organismo,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div>

        <div class="col-md-4">
        <div class="form-group">
        <?php
        echo form_label('Rol', 'rol');

        $input = array(
            'name' => 'celular',
            'value' => $rol,
            'readonly' => 'readonly',
            'class' => 'form-control form-control-sm'
        );

        echo form_input($input);
        ?>
    </div></div></div>


    <?php
   /*  $options = array(
    '1' => 'Secretaria Técnica de Planeación y Evaluación'
    );
    echo form_dropdown('organismo', 
    $options, 
    'Secretaria Técnica de Planeación y Evaluación', 
    'class="form-group"'
    ); */ ?>

    <?php
   /*  $options = array(
    '1' => 'Administrador',
    '2' => 'Evaluador'
    );
    echo form_dropdown('rol', 
    $options, 
    'Administrador', 
    'class="form-group"'
    ); */ ?>

    <?php //echo form_submit('mysubmit', 'Enviar', "class='btn btn-primary'"); ?>
    <center>
    <button type="button" class="btn btn-white" onclick="regresar();">Regresar</button> 
    </center>
    
<?php echo form_close();?>
    </div>
    </div><br>
    </div>
</body>
<script>
function regresar(e){
        if (!e) { var e = window.event; }
        e.preventDefault();

        cargar('<?=base_url();?>C_usuario/listado','#contenido','POST');
    }
</script>

</html>