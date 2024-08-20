

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card p-4 shadow-lg">
                <h3 class="text-center mb-4">Encuentra Películas en Común</h3>
                <form action="<?php echo e(route('match.search')); ?>" method="POST" class="row g-3">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-6 position-relative">
                        <label for="movie1" class="form-label">Selecciona tu película:</label>
                        <?php if(request('movie1')): ?>
                        <input type="text" name="movie1" id="movie1" class="form-control" placeholder="Buscar película" value="<?php echo e(request('movie1')); ?>" required>
                        <?php else: ?>
                        <input type="text" name="movie1" id="movie1" class="form-control" placeholder="Buscar película" required>
                        <?php endif; ?>
                        <div id="movie1-loading" class="loading-spinner d-none position-absolute top-50 end-0 translate-middle">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="movie2" class="form-label">Seleccionar una película:</label>
                        <input type="text" name="movie2" id="movie2" class="form-control" placeholder="Buscar película" value="<?php echo e(request('movie2')); ?>" required>
                        <div id="movie2-loading" class="loading-spinner d-none position-absolute top-50 end-0 translate-middle">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5">Buscar Películas en Común</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <?php if(isset($movies)): ?>
            <?php if(count($movies) > 0): ?>
                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <a data-toggle="modal" data-target="#movieModal<?php echo e($movie['id']); ?>">
                                <img src="https://image.tmdb.org/t/p/w500/<?php echo e($movie['poster_path']); ?>" class="card-img-top" alt="<?php echo e($movie['title']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($movie['title']); ?></h5>
                                    <p class="card-text">Rating: <?php echo e(number_format($movie['vote_average'], 1)); ?>/10</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="movieModal<?php echo e($movie['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel<?php echo e($movie['id']); ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="movieModalLabel<?php echo e($movie['id']); ?>"><?php echo e($movie['title']); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="https://image.tmdb.org/t/p/w500/<?php echo e($movie['poster_path']); ?>" class="img-fluid mb-3" alt="<?php echo e($movie['title']); ?>">
                                    <p><strong>Rating:</strong> <?php echo e(number_format($movie['vote_average'], 1)); ?>/10</p>
                                    <p><strong>Overview:</strong> <?php echo e($movie['overview']); ?></p>
                                </div>
                                <div class="modal-footer">
                                    <a href="https://www.themoviedb.org/movie/<?php echo e($movie['id']); ?>" class="btn btn-primary" target="_blank">+Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="text-muted">No se encontraron películas en común.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    $(function() {
        function fetchSuggestions(request, response, elementId) {
            $(`#${elementId}-loading`).removeClass('d-none'); // Muestra el spinner de carga
            $.ajax({
                url: 'https://api.themoviedb.org/3/search/movie',
                dataType: 'json',
                data: {
                    api_key: '<?php echo e(env('TMDB_API_KEY')); ?>',
                    query: request.term
                },
                success: function(data) {
                    response(data.results.map(function(movie) {
                        return {
                            label: movie.title,
                            value: movie.title,
                            id: movie.id
                        };
                    }));
                },
                complete: function() {
                    $(`#${elementId}-loading`).addClass('d-none'); // Oculta el spinner de carga
                }
            });
        }

        // Configuración de autocompletado para ambas casillas
        $("#movie1").autocomplete({
            source: function(request, response) {
                fetchSuggestions(request, response, 'movie1');
            },
            select: function(event, ui) {
                console.log("Selected movie ID:", ui.item.id);
            },
            minLength: 3,
            delay: 300
        });

        $("#movie2").autocomplete({
            source: function(request, response) {
                fetchSuggestions(request, response, 'movie2');
            },
            select: function(event, ui) {
                console.log("Selected movie ID:", ui.item.id);
            },
            minLength: 3,
            delay: 300
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jp23\Desktop\FilmGenius\resources\views/movies/match.blade.php ENDPATH**/ ?>