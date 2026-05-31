<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новогодние мероприятия - Заявка</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #ff9900;
        }
        .form-control.error {
            border-color: #dc3545;
        }
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: normal;
        }
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        .radio-group label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: normal;
        }
        fieldset {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        legend {
            padding: 0 10px;
            font-weight: 600;
        }
        fieldset.error {
            border-color: #dc3545;
        }
        .btn-submit {
            background: #ff9900;
            color: #fff;
            border: none;
            padding: 14px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }
        .btn-submit:hover {
            background: #e68a00;
        }
        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .message.info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin-left: 10px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .auth-info {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        .nav-links-extra {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        .nav-links-extra a {
            color: #ff9900;
            text-decoration: none;
        }
        <?php if (!empty($c['is_authenticated'])): ?>
        .profile-data {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        <?php endif; ?>
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 style="text-align: center; color: #ff9900; margin-bottom: 30px;">Заявка на участие в мероприятии</h1>
            
            <?php if (!empty($c['messages'])): ?>
                <?php foreach ($c['messages'] as $msg): ?>
                    <?php echo $msg; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if (!empty($c['is_authenticated'])): ?>
                <div class="auth-info">
                    <i class="fas fa-user"></i> Вы вошли как <strong><?php echo htmlspecialchars($c['username']); ?></strong>
                    <button id="logoutBtn" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Выйти</button>
                </div>
            <?php endif; ?>
            
            <div id="formMessage"></div>
            
            <form id="mainForm" method="POST" action="<?php echo url('api'); ?>">
                <div class="form-group">
                    <label for="name">ФИО *</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                    <span class="error-message" id="nameError"></span>
                </div>
                
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="+7 (XXX) XXX-XX-XX">
                    <span class="error-message" id="phoneError"></span>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="example@mail.com">
                    <span class="error-message" id="emailError"></span>
                </div>
                
                <div class="form-group">
                    <label for="birthdate">Дата рождения</label>
                    <input type="date" id="birthdate" name="birthdate" class="form-control">
                    <span class="error-message" id="birthdateError"></span>
                </div>
                
                <div class="form-group">
                    <label>Пол *</label>
                    <div class="radio-group">
                        <label><input type="radio" name="sex" value="male"> Мужской</label>
                        <label><input type="radio" name="sex" value="female"> Женский</label>
                    </div>
                    <span class="error-message" id="sexError"></span>
                </div>
                
                <fieldset id="languagesFieldset">
                    <legend>Любимый язык программирования *</legend>
                    <div class="checkbox-group" id="languagesGroup">
                        <?php
                        $languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
                        foreach ($languages as $lang): ?>
                        <label><input type="checkbox" name="languages[]" value="<?php echo $lang; ?>"> <?php echo $lang; ?></label>
                        <?php endforeach; ?>
                    </div>
                    <span class="error-message" id="languagesError"></span>
                </fieldset>
                
                <div class="form-group">
                    <label for="biography">Биография</label>
                    <textarea id="biography" name="biography" class="form-control" rows="5"></textarea>
                </div>
                
                <div class="form-group">
                    <label><input type="checkbox" name="contract" value="1" id="contract"> Я ознакомлен(а) с условиями *</label>
                    <span class="error-message" id="contractError"></span>
                </div>
                
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span id="submitText">Отправить заявку</span>
                    <span id="submitSpinner" style="display: none;"></span>
                </button>
            </form>
            
            <div class="nav-links-extra">
                <a href="/">← На главную</a>
                <?php if (empty($c['is_authenticated'])): ?>
                <a href="<?php echo url('login'); ?>">Войти</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script>
    (function() {
        // Проверяем, включен ли JavaScript
        document.documentElement.classList.add('js-enabled');
        
        const form = document.getElementById('mainForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');
        const formMessage = document.getElementById('formMessage');
        
        // Функция очистки ошибок
        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('.form-control.error').forEach(el => el.classList.remove('error'));
            document.getElementById('languagesFieldset')?.classList.remove('error');
        }
        
        // Функция отображения ошибок
        function displayErrors(errors) {
            clearErrors();
            for (const [field, message] of Object.entries(errors)) {
                const errorSpan = document.getElementById(field + 'Error');
                if (errorSpan) {
                    errorSpan.textContent = message;
                }
                const input = document.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add('error');
                }
                if (field === 'languages') {
                    document.getElementById('languagesFieldset')?.classList.add('error');
                }
                if (field === 'contract') {
                    document.getElementById('contract')?.classList.add('error');
                }
            }
        }
        
        // Функция показа сообщения
        function showMessage(message, type) {
            formMessage.innerHTML = `<div class="message ${type}">${message}</div>`;
            formMessage.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        
        // Функция загрузки данных профиля (если авторизован)
        <?php if (!empty($c['is_authenticated'])): ?>
        async function loadProfile() {
            try {
                const response = await fetch('<?php echo url('api/profile'); ?>', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Basic ' + btoa('<?php echo addslashes($c['username']); ?>:')
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    // Заполняем форму данными
                    if (data.name) document.getElementById('name').value = data.name;
                    if (data.phone) document.getElementById('phone').value = data.phone;
                    if (data.email) document.getElementById('email').value = data.email;
                    if (data.birthdate) document.getElementById('birthdate').value = data.birthdate;
                    if (data.sex) {
                        const radio = document.querySelector(`input[name="sex"][value="${data.sex}"]`);
                        if (radio) radio.checked = true;
                    }
                    if (data.biography) document.getElementById('biography').value = data.biography;
                    if (data.languages) {
                        document.querySelectorAll('input[name="languages[]"]').forEach(cb => {
                            cb.checked = data.languages.includes(cb.value);
                        });
                    }
                    document.getElementById('contract').checked = true;
                    document.getElementById('contract').disabled = true;
                }
            } catch (error) {
                console.error('Ошибка загрузки профиля:', error);
            }
        }
        loadProfile();
        <?php endif; ?>
        
        // Обработка отправки формы
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                clearErrors();
                formMessage.innerHTML = '';
                
                // Собираем данные формы
                const formData = new FormData(form);
                const languages = formData.getAll('languages[]');
                
                const data = {
                    name: formData.get('name'),
                    phone: formData.get('phone') || '',
                    email: formData.get('email') || '',
                    birthdate: formData.get('birthdate') || '',
                    sex: formData.get('sex'),
                    languages: languages,
                    biography: formData.get('biography') || '',
                    contract: formData.get('contract') || ''
                };
                
                // Определяем метод (PUT для авторизованных, POST для новых)
                <?php if (!empty($c['is_authenticated'])): ?>
                const method = 'PUT';
                const url = '<?php echo url('api/profile'); ?>';
                <?php else: ?>
                const method = 'POST';
                const url = '<?php echo url('api'); ?>';
                <?php endif; ?>
                
                // Показываем спиннер
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitSpinner.style.display = 'inline-block';
                
                try {
                    const headers = {
                        'Content-Type': 'application/json'
                    };
                    
                    <?php if (!empty($c['is_authenticated'])): ?>
                    headers['Authorization'] = 'Basic ' + btoa('<?php echo addslashes($c['username']); ?>:');
                    <?php endif; ?>
                    
                    const response = await fetch(url, {
                        method: method,
                        headers: headers,
                        body: JSON.stringify(data)
                    });
                    
                    const result = await response.json();
                    
                    if (response.ok) {
                        showMessage(result.message, 'success');
                        if (result.login && result.password) {
                            showMessage(`${result.message}<br>Логин: <strong>${result.login}</strong><br>Пароль: <strong>${result.password}</strong>`, 'success');
                        }
                        if (!<?php echo json_encode(!empty($c['is_authenticated'])); ?>) {
                            form.reset();
                        }
                    } else if (result.errors) {
                        displayErrors(result.errors);
                        showMessage('Пожалуйста, исправьте ошибки в форме', 'error');
                    } else {
                        showMessage(result.error || 'Произошла ошибка при отправке', 'error');
                    }
                } catch (error) {
                    console.error('Ошибка:', error);
                    showMessage('Ошибка сети. Пожалуйста, проверьте подключение.', 'error');
                } finally {
                    submitBtn.disabled = false;
                    submitText.style.display = 'inline';
                    submitSpinner.style.display = 'none';
                }
            });
        }
        
        // Выход из системы
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', async function() {
                try {
                    await fetch('<?php echo url('logout'); ?>', { method: 'POST' });
                    window.location.href = '<?php echo url('form'); ?>';
                } catch (error) {
                    window.location.href = '<?php echo url('form'); ?>';
                }
            });
        }
    })();
    </script>
    
    <!-- Fallback: если JS отключен, форма отправится обычным POST-запросом -->
    <noscript>
        <style>
            .js-only { display: none; }
        </style>
        <div class="message info" style="margin-top: 20px;">
            <i class="fas fa-info-circle"></i> JavaScript отключен. Форма будет отправлена обычным способом.
        </div>
    </noscript>
</body>
</html>