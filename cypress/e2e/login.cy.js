// cypress/e2e/login_validacion.cy.js
describe('Módulo de Acceso', () => {
  it('Validar autenticación y segregación de roles', () => {
    cy.visit('http://localhost:81/final/public/login'); 

    cy.get('input[name="email"]').type('12vargasleosarturonew@gmail.com');
    cy.get('input[name="password"]').type('12345678');
    cy.get('button[type="submit"]').click();

    // Esperar a que la URL cambie (evita el error de velocidad)
    cy.url().should('not.include', 'http://localhost:81/final/public/login'); 
    
    // El dropdown-toggle debe ser clickeado para que el DOM muestre el texto
    cy.get('.dropdown-toggle').should('be.visible').click(); 
    cy.contains('Cerrar Sesión').should('be.visible');
  });
});
// cypress/e2e/registro_usuarios.cy.js
it('Validar integridad de formulario de registro público', () => {
  // Verifica si tu ruta es /register o /registro
  cy.visit('http://localhost:81/final/public/register');

  cy.get('input[name="name"]').type('Arturo');
  cy.get('input[name="last_name"]').type('Vargas');
  cy.get('input[name="email"]').type('registro.final@nutripeques.com');
  cy.get('input[name="password"]').type('nutri2026');

  cy.get('button[type="submit"]').click();

  // Validamos que redirija al login tras el éxito en Firebase
  cy.url({ timeout: 10000 }).should('include', 'http://localhost:81/final/public/login');
  cy.get('body').should('contain', 'Cuenta creada');
});
// cypress/e2e/core_functionality.cy.js
it('Funcionalidad Principal: Actualización de Perfil en Tiempo Real', () => {
  cy.visit('http://localhost:81/final/public/perfil');

  // Limpieza e ingreso de nuevos datos
  cy.get('input[name="nombre"]').should('be.visible').clear().type('Arturo Editado');
  cy.get('input[name="apellido"]').should('be.visible').clear().type('Vargas Test');
  
  // En lugar de id, usamos el tipo submit que es más seguro
  cy.get('button[type="submit"]').click();

  // Verificación de la alerta de Laravel tras el PATCH en Firebase
  cy.get('.alert-success', { timeout: 8000 })
    .should('be.visible')
    .and('contain', 'Perfil actualizado');
});