from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import time
import unittest
import os
import random
import string


class TestFuncionarios(unittest.TestCase):

    @classmethod
    def setUpClass(cls):
        cls.driver = webdriver.Chrome()
        cls.driver.maximize_window()
        cls.driver.get("http://localhost:8080/PHP_VINICIUSPASSOS/AULAS_PHP/FORNEINJET_PHP/")
        cls.test_user = "testuser_" + ''.join(random.choices(string.ascii_lowercase, k=5))
        cls.test_email = cls.test_user + "@example.com"

    def test_1_add_funcionario(self):
        """Teste de Cadastro de Funcionário"""
        driver = self.driver

        # Navegar para a página de cadastro
        driver.find_element(By.LINK_TEXT, "Adicionar Funcionário").click()
        
        # Preencher o formulário
        driver.find_element(By.NAME, "nome").send_keys("João Silva")
        driver.find_element(By.NAME, "cargo").send_keys("Desenvolvedor")
        driver.find_element(By.NAME, "telefone").send_keys("(11) 99999-9999")
        driver.find_element(By.NAME, "email").send_keys(self.test_email)
        driver.find_element(By.NAME, "usuario").send_keys(self.test_user)
        driver.find_element(By.NAME, "senha").send_keys("Senha@123")
        
        # Selecionar permissão e situação
        Select(driver.find_element(By.NAME, "permissao")).select_by_value("usuario")
        Select(driver.find_element(By.NAME, "situacao")).select_by_value("ativo")
        
        # Preencher data de admissão
        driver.find_element(By.NAME, "data_admissao").send_keys("01012023")
        
        # Submeter o formulário
        driver.find_element(By.CSS_SELECTOR, "button.btn-primary").click()

        # Verificar mensagem de sucesso
        WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.CLASS_NAME, "alert-success")))
        success_message = driver.find_element(By.CLASS_NAME, "alert-success").text
        self.assertIn("Funcionário cadastrado com sucesso", success_message)

    def test_2_edit_funcionario(self):
        """Teste de Edição de Funcionário"""
        driver = self.driver
        
        # Navegar para a lista de funcionários
        driver.find_element(By.LINK_TEXT, "Listar Funcionários").click()

        # Localizar e clicar no botão editar do funcionário de teste
        btn_editar = WebDriverWait(driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, 
                f"//tr[td[contains(text(),'{self.test_user}')]]//a[contains(@class, 'btn-warning')]")))
        btn_editar.click()

        # Editar informações
        campo_cargo = WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.NAME, "cargo")))
        campo_cargo.clear()
        campo_cargo.send_keys("Gerente de Projetos")
        
        # Alterar permissão
        Select(driver.find_element(By.NAME, "permissao")).select_by_value("gestor")
        
        # Submeter o formulário
        driver.find_element(By.CSS_SELECTOR, "button.btn-primary").click()

        # Verificar mensagem de sucesso
        WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.CLASS_NAME, "alert-success")))
        success_message = driver.find_element(By.CLASS_NAME, "alert-success").text
        self.assertIn("Atualizado com sucesso", success_message)

    def test_3_delete_funcionario(self):
        """Teste de Exclusão de Funcionário"""
        driver = self.driver

        # Navegar para a lista de funcionários
        driver.find_element(By.LINK_TEXT, "Listar Funcionários").click()
        
        # Localizar e clicar no botão excluir do funcionário de teste
        btn_excluir = WebDriverWait(driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, 
                f"//tr[td[contains(text(),'{self.test_user}')]]//a[contains(@class, 'btn-danger')]")))
        btn_excluir.click()
        
        # Confirmar a exclusão no alerta
        WebDriverWait(driver, 5).until(EC.alert_is_present())
        alert = driver.switch_to.alert
        alert.accept()

        # Verificar se o funcionário foi removido da lista
        WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.TAG_NAME, "table")))
        lista_funcionarios = driver.find_element(By.TAG_NAME, "table").text
        self.assertNotIn(self.test_user, lista_funcionarios)

    @classmethod
    def tearDownClass(cls):
        cls.driver.quit()


if __name__ == "__main__":
    unittest.main()