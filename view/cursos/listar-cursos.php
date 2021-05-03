<?php include __DIR__ . '/../header.html'; ?>


    <a href="/novo-curso" class="btn btn-primary mb-2">
        Novo Curso
    </a>

    <ul class="list-group">
        <?php foreach ($cursos as $curso): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $curso->getDescricao(); ?>
                <a href="/excluir-curso" class="btn btn-danger btn-sm">
                    Excluir
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php include __DIR__ . '/../footer.html'; ?>