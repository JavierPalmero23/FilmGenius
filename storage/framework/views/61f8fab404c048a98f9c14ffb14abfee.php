

<?php $__env->startSection('content'); ?>

<div class="container">
    <h1><?php echo e($type === 'alphabetical' ? 'Alfabeticamente' : ($type === 'category' ?  $categoryName : 'Popular')); ?></h1>

    <!-- Botones para cambiar entre popular, alfabético y categoría -->
    <div class="mb-3 d-flex align-items-center">
    <a href="<?php echo e(route('movies.index', ['type' => 'popular', 'page' => $currentPage])); ?>" class="btn btn-primary mr-2">Popular</a>
    <a href="<?php echo e(route('movies.index', ['type' => 'alphabetical', 'page' => $currentPage])); ?>" class="btn btn-secondary mr-2">Alfabeticamente</a>

    <!-- Selección de categoría -->
    <select onchange="location = this.value;" class="btn btn-outline-dark mr-2">
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => null])); ?>" <?php echo e(is_null($categoryId) ? 'selected' : ''); ?>>Todas</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 16])); ?>" <?php echo e($categoryId == 16 ? 'selected' : ''); ?>>Animacion</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 12])); ?>" <?php echo e($categoryId == 12 ? 'selected' : ''); ?>>Aventura</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 28])); ?>" <?php echo e($categoryId == 28 ? 'selected' : ''); ?>>Accion</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 35])); ?>" <?php echo e($categoryId == 35 ? 'selected' : ''); ?>>Comedia</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 80])); ?>" <?php echo e($categoryId == 80 ? 'selected' : ''); ?>>Crimen</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 99])); ?>" <?php echo e($categoryId == 99 ? 'selected' : ''); ?>>Documental</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 18])); ?>" <?php echo e($categoryId == 18 ? 'selected' : ''); ?>>Drama</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10751])); ?>" <?php echo e($categoryId == 10751 ? 'selected' : ''); ?>>Familiar</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 14])); ?>" <?php echo e($categoryId == 14 ? 'selected' : ''); ?>>Fantasia</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 36])); ?>" <?php echo e($categoryId == 36 ? 'selected' : ''); ?>>Historia</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 27])); ?>" <?php echo e($categoryId == 27 ? 'selected' : ''); ?>>Horror</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10402])); ?>" <?php echo e($categoryId == 10402 ? 'selected' : ''); ?>>Musical</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 9648])); ?>" <?php echo e($categoryId == 9648 ? 'selected' : ''); ?>>Misterio</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10749])); ?>" <?php echo e($categoryId == 10749 ? 'selected' : ''); ?>>Romance</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 878])); ?>" <?php echo e($categoryId == 878 ? 'selected' : ''); ?>>Ciencia Ficcion</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10770])); ?>" <?php echo e($categoryId == 10770 ? 'selected' : ''); ?>>De Serie A Pelicula</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 53])); ?>" <?php echo e($categoryId == 53 ? 'selected' : ''); ?>>Suspenso</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10752])); ?>" <?php echo e($categoryId == 10752 ? 'selected' : ''); ?>>Guerra</option>
        <option value="<?php echo e(route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 37])); ?>" <?php echo e($categoryId == 37 ? 'selected' : ''); ?>>Vaqueeros</option>
    </select>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="<?php echo e(route('movies.index')); ?>" class="d-flex align-items-center">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search for movies..." value="<?php echo e($searchQuery); ?>">
        <input type="hidden" name="type" value="<?php echo e($type); ?>">
        <input type="hidden" name="category" value="<?php echo e($categoryId); ?>">
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
</div>

    <div class="row">
        <?php $__currentLoopData = $tmdbMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card">
                <a data-toggle="modal" data-target="#movieModal<?php echo e($movie['id']); ?>">
                    <img src="https://image.tmdb.org/t/p/w500/<?php echo e($movie['poster_path']); ?>" class="card-img-top" alt="<?php echo e($movie['title']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($movie['title']); ?></h5>
                        <p class="card-text">
                            Rating: <?php echo e(number_format($movie['vote_average'], 1)); ?>/10
                        </p>
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
                        <?php if(auth()->guard()->check()): ?>
                        <!-- Botón de Acción para Usuarios Autenticados -->
                        <a href="<?php echo e(route('match.index', ['movie1' => $movie['title']])); ?>" class="btn btn-primary">Match</a>
                        <?php endif; ?>
                        <a href="https://www.themoviedb.org/movie/<?php echo e($movie['id']); ?>" class="btn btn-primary" target="_blank">+Info</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- Botones de Paginación -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <!-- Botón Anterior -->
        <?php if($currentPage > 1): ?>
        <li class="page-item">
            <a class="page-link" href="?<?php if($searchQuery): ?>search=<?php echo e($searchQuery); ?><?php endif; ?>&page=<?php echo e($currentPage - 1); ?>&type=<?php echo e($type); ?><?php if($categoryId): ?> &category=<?php echo e($categoryId); ?> <?php endif; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo; Anterior</span>
            </a>
        </li>
        <?php endif; ?>

        <!-- Primera Página -->
        <?php if($currentPage > 4): ?>
        <li class="page-item">
            <a class="page-link" href="?<?php if($searchQuery): ?>search=<?php echo e($searchQuery); ?><?php endif; ?>&page=1&type=<?php echo e($type); ?><?php if($categoryId): ?> &category=<?php echo e($categoryId); ?> <?php endif; ?>">1</a>
        </li>
        <?php if($currentPage > 5): ?>
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        <?php endif; ?>
        <?php endif; ?>

        <!-- Páginas Iniciales -->
        <?php for($i = max(2, $currentPage - 2); $i < $currentPage; $i++): ?>
            <li class="page-item">
            <a class="page-link" href="?<?php if($searchQuery): ?>search=<?php echo e($searchQuery); ?><?php endif; ?>&page=<?php echo e($i); ?>&type=<?php echo e($type); ?><?php if($categoryId): ?> &category=<?php echo e($categoryId); ?> <?php endif; ?>"><?php echo e($i); ?></a>
            </li>
            <?php endfor; ?>

            <!-- Página Actual -->
            <li class="page-item active">
                <span class="page-link"><?php echo e($currentPage); ?></span>
            </li>

            <!-- Páginas Siguientes -->
            <?php for($i = $currentPage + 1; $i <= min($currentPage + 2, min(500, $totalPages)); $i++): ?>
                <li class="page-item">
                <a class="page-link" href="?<?php if($searchQuery): ?>search=<?php echo e($searchQuery); ?><?php endif; ?>&page=<?php echo e($i); ?>&type=<?php echo e($type); ?><?php if($categoryId): ?> &category=<?php echo e($categoryId); ?> <?php endif; ?>"><?php echo e($i); ?></a>
                </li>
                <?php endfor; ?>

                <!-- Última Página -->
                <?php if($currentPage < min(500, $totalPages) - 3): ?>
                    <?php if($currentPage < min(500, $totalPages) - 4): ?>
                    <li class="page-item disabled">
                    <span class="page-link">...</span>
                    </li>
                    <?php endif; ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?php if($searchQuery): ?>search=<?php echo e($searchQuery); ?><?php endif; ?>&page=<?php echo e(min(500, $totalPages)); ?>&type=<?php echo e($type); ?><?php if($categoryId): ?> &category=<?php echo e($categoryId); ?> <?php endif; ?>"><?php echo e(min(500, $totalPages)); ?></a>
                    </li>
                    <?php endif; ?>

                    <!-- Botón Siguiente -->
                    <?php if($currentPage < min(500, $totalPages)): ?>
                        <li class="page-item">
                        <a class="page-link" href="?<?php if($searchQuery): ?>search=<?php echo e($searchQuery); ?><?php endif; ?>&page=<?php echo e($currentPage + 1); ?>&type=<?php echo e($type); ?><?php if($categoryId): ?> &category=<?php echo e($categoryId); ?> <?php endif; ?>" aria-label="Next">
                            <span aria-hidden="true">Siguiente &raquo;</span>
                        </a>
                        </li>
                        <?php endif; ?>
    </ul>
</nav>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jp23\Desktop\FilmGenius\resources\views/movies/index.blade.php ENDPATH**/ ?>