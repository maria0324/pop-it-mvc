<div class="add-user-container">
    <h2>Добавление сотрудника</h2>
    <h3><?= $message ?? ''; ?></h3>
    <form method="post">

        <label>Логин <input type="text" name="login"></label>
        <label>Пароль <input type="password" name="password"></label>
        <button>Добавить</button>
    </form>

</div>
