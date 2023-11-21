<style>
  .fondo {
  background-image: url("../public/images/imagen_fondo.jpg");
  height:80%;
  }
  .container
  {
    color:white;
    text-align: center;
    font-size:25px;
    padding-bottom: 1%;
  }
  .mb-md-3
  {
    font-size:22px;
  }
  .fw-bold
  {
    font-size:22px;
  }

  .text-white-50{
    font-size: 18px;
  }


  </style>

<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>




<div class="fondo" >

<section  >
    <div>
      <div class="row d-flex justify-content-center align-items-center h-100">      
        <div >       
          <div class="card bg-dark text-white" style="border-radius: 1rem;">     
            <div class="card-body p-10 text-center">
              <div class="mb-md-3 mt-md-7 pb-2">          
                <form method="post" action="usuarios.php">
                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <?php if(isset($error)): ?>
                    <p class="text-white-50 mb-10"><span style="color:red;"><?php echo e($error); ?></span></p>
                    <?php else: ?>
                    <p class="text-white-50 mb-10">Introduce tu nombre de usuario</p>
                    <?php endif; ?>

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
  <footer style="text-align: center;padding-top:2%;">
    <h4 style="color:midnightblue">Paula Salicio Geanini Proyecto DAW</h4>
  </footer> 
</div>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>