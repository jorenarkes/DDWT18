<!-- Series count -->
<div class="card">
    <div class="card-header">
        Series
    </div>
    <div class="card-body">
        <p class="count">Series overview already has</p>
        <h2><?= count_series($db) ?></h2>
        <a href="/DDWT18/week2/add/" class="btn btn-primary">List yours</a>
    </div>
    <div class="card-header">
        Users
    </div>
    <div class="card-body">
        <p>active users</p>
        <h2><?= count_users($db) ?></h2>
        <a href="/DDWT18/week2/register/" class="btn btn-primary">Sign up</a>
    </div>
</div>