<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg" style="background-color: #1d021f;">
                    <h3 class="text-center mb-4" style="color: #bd0cc9;">Regístrate en FilmGenius</h3>
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label" style="color: #bd0cc9;">Nombre</label>
                            <input id="name" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                            <?php if($errors->has('name')): ?>
                                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label" style="color: #bd0cc9;">Correo Electrónico</label>
                            <input id="email" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="email" name="email" :value="old('email')" required autocomplete="username">
                            <?php if($errors->has('email')): ?>
                                <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label" style="color: #bd0cc9;">Contraseña</label>
                            <input id="password" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="password" name="password" required autocomplete="new-password">
                            <?php if($errors->has('password')): ?>
                                <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label" style="color: #bd0cc9;">Confirmar Contraseña</label>
                            <input id="password_confirmation" class="form-control" style="background-color: #2c052f; color: #FFFFFF;" type="password" name="password_confirmation" required autocomplete="new-password">
                            <?php if($errors->has('password_confirmation')): ?>
                                <small class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-light px-5" style="background-color: #6d0774; color: #FFFFFF;">Registrarse</button>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="<?php echo e(route('login')); ?>" class="text-sm" style="color: #bd0cc9;">¿Ya tienes una cuenta? Inicia sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\jp23\Desktop\FilmGenius\resources\views/auth/register.blade.php ENDPATH**/ ?>