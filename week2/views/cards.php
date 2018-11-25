<!-- Series count -->
<div class="card">
    <div class="card-header">
        Users
    </div>
    <div class="card-body">
        <p class="count">Series overview already has</p>
        <h2><?= count_series($db) ?></h2>
        <p>active users</p>
        <h3><?= count_users($db) ?></h3>
        <a href="/DDWT18/week2/add/" class="btn btn-primary">List yours</a>
    </div>
</div>