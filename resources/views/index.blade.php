<html>
	<head>
        <title>Wallet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">		
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" 
                rel="stylesheet" 
                integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
                crossorigin="anonymous">
        <link href="css/custom.css" rel="stylesheet"/>				
                
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
                crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>        
	</head>

	<body class="bg-light">
		<div class="col-md-4 position-absolute top-50 start-50 translate-middle">
			<div class="header rounded border bg-white shadow-sm">
				<form action="{{ route('dashboard') }}" method="post">
					<div class="card-header pt-0">
						<h3 class="p-3 pb-0">Iniciar sesión</h3>
					</div>					
					<div class="card-body">
						<p>Rellene los campos para iniciar sesion.</p>		
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label">Usuario</label>
							<div class="col-sm-10">
								<input type="text" name="username" class="form-control" placeholder="Usuario" autocomplete="off"/>
							</div>
						</div>
							
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label">Contraseña</label>			
							<div class="col-md-10">
								<input type="password" name="password" class="form-control" placeholder="Contraseña" autocomplete="off"/>
							</div>
						</div>
							
						<div class="d-grid gap-2 d-md-flex justify-content-md-end">
							<button class="btn btn-primary" type="submit">Aceptar</button>
						  	<button class="btn btn-primary" type="reset">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
				integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" 
				crossorigin="anonymous">
		</script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</body>
</html>