<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<style>
  .fondo {
  background-image: url("../public/images/imagen_fondo.jpg");
  }
  </style>

<div class="fondo">

<section class="vh-100 gradient-custom" >

  
    <div class="container py-5 h-100" >

      <div class="row d-flex justify-content-center align-items-center h-100">
        
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                
                <form method="post" action="usuarios.php">
                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Introduce tu nombre de usuario</p>
    
                    <div class="form-outline form-white mb-4">
                    <input type="text" name="login" id="login" placeholder="Login"  required class="form-control form-control-lg" />
                    
                    </div>
    
                    <div class="form-outline form-white mb-4">
                    <input type="password" name="password" id="password" placeholder="Password" required class="form-control form-control-lg" />
                    </div>
    
    
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </form>
                    
              </div>
  
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
  
<?php $__env->stopSection(); ?>
<footer>
  Paula Salicio Geanini Proyecto DAW
</footer>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>