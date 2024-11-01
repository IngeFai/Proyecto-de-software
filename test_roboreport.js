const { Builder, By, until } = require('selenium-webdriver');

(async function testRoboReport() {
    let driver = await new Builder().forBrowser('chrome').build();

    try {
        // Abre la página de inicio de tu proyecto
        await driver.get('http://localhost/RoboReport/');

        // Espera hasta que el campo de correo electrónico esté presente
        let emailField = await driver.wait(until.elementLocated(By.name('email')), 10000); // espera hasta 10 segundos
        await emailField.sendKeys('kuellitar14@gmail.com'); // Ingresa tu correo de prueba

        // Espera hasta que el campo de contraseña esté presente
        let passwordField = await driver.wait(until.elementLocated(By.name('password')), 10000); 
        await passwordField.sendKeys('12345'); // Ingresa tu contraseña de prueba

        // Busca el botón de login por su tipo y haz clic
        let loginButton = await driver.findElement(By.css('button[type="submit"]'));
        await loginButton.click();

        // Espera unos segundos para observar el resultado
        await driver.sleep(3000);
    } finally {
        // Cierra el navegador
        await driver.quit();
    }
})();
