

<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('match.search')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label for="movie1">Selecciona tu película:</label>
            <input type="text" name="movie1" id="movie1" placeholder="Buscar película" required>

            <label for="movie2">Seleccionar una película:</label>
            <input type="text" name="movie2" id="movie2" placeholder="Buscar película" required>

            <button type="submit">Buscar Películas en Común</button>
        </form>
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
                                    <p class="card-text">
                                        Rating: <?php echo e(number_format($movie['vote_average'], 1)); ?>/10
                                    </p>
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
                <p>No se encontraron películas en común.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script>
        $(function() {
            // Función para obtener sugerencias
            function fetchSuggestions(request, response) {
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
                    }
                });
            }

            // Configuración de autocompletado
            $("#movie1, #movie2").autocomplete({
                source: fetchSuggestions,
                select: function(event, ui) {
                    // Puedes usar ui.item.id para enviar el id de la película si es necesario
                    console.log("Selected movie ID:", ui.item.id);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jp23\Desktop\FilmGenius\resources\views/movies/match.blade.php ENDPATH**/ ?>