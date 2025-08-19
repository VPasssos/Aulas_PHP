from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
import unittest
import os


class TestFuncionarios(unittest.TestCase):

    @classmethod
    def setUpClass(cls):
        cls.driver = webdriver.Chrome()
        cls.driver.maximize_window()
        cls.driver.get("http://localhost:8080/PHP_VINICIUSPASSOS/AULAS_PHP/ATIV14.1_VINICIUS_DOS_PASSOS/.")
        cls.test_image_path = os.path.join(os.getcwd(), "test_image.jpg")
        if not os.path.exists(cls.test_image_path):
            with open(cls.test_image_path, 'wb') as f:
                f.write(b'\x89PNG\r\n\x1a\n\x00\x00\x00\rIHDR\x00\x00\x00\x01\x00\x00\x00\x01\x08\x02\x00\x00\x00\x90wS\xde\x00\x00\x00\x0cIDAT\x08\xd7c\xf8\xff\xff?\x00\x05\xfe\x02\xfe\xdc\xccY\xe7\x00\x00\x00\x00IEND\xaeB`\x82')

    def test_1_add_funcionario(self):
        """Teste de Cadastro de Funcionário"""
        driver = self.driver

        driver.find_element(By.LINK_TEXT, "Adicionar Funcionário").click()
        
        driver.find_element(By.NAME, "nome").send_keys("João Silva")
        driver.find_element(By.NAME, "cargo").send_keys("Desenvolvedor")
        
        driver.find_element(By.NAME, "foto").send_keys(self.test_image_path)
        
        driver.find_element(By.CSS_SELECTOR, "button.btn-primary").click()

        WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.CLASS_NAME, "alert-success"))
        )
        success_message = driver.find_element(By.CLASS_NAME, "alert-success").text
        self.assertIn("Funcionário cadastrado com sucesso", success_message)

    def test_2_edit_funcionario(self):
        """Teste de Edição de Funcionário"""
        driver = self.driver
        
        driver.find_element(By.LINK_TEXT, "Listar Funcionários").click()

        btn_editar = WebDriverWait(driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//tr[td[contains(text(),'João Silva')]]//a[contains(@class, 'btn-warning')]"))
        )
        btn_editar.click()

        campo_cargo = WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.NAME, "cargo"))
        )
        campo_cargo.clear()
        campo_cargo.send_keys("Gerente de Projetos")
        driver.find_element(By.CSS_SELECTOR, "button.btn-primary").click()

        WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.CLASS_NAME, "alert-success"))
        )
        success_message = driver.find_element(By.CLASS_NAME, "alert-success").text
        self.assertIn("Atualizado com sucesso", success_message)

    def test_3_delete_funcionario(self):
        """Teste de Exclusão de Funcionário"""
        driver = self.driver

        driver.find_element(By.LINK_TEXT, "Listar Funcionários").click()
        
        btn_excluir = WebDriverWait(driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//tr[td[contains(text(),'João Silva')]]//a[contains(@class, 'btn-danger')]"))
        )
        btn_excluir.click()
        
        WebDriverWait(driver, 5).until(EC.alert_is_present())
        alert = driver.switch_to.alert
        alert.accept()

        WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.TAG_NAME, "table"))
        )
        lista_funcionarios = driver.find_element(By.TAG_NAME, "table").text
        self.assertNotIn("João Silva", lista_funcionarios)

    @classmethod
    def tearDownClass(cls):
        cls.driver.quit()
        if os.path.exists(cls.test_image_path):
            os.remove(cls.test_image_path)


if __name__ == "__main__":
    unittest.main()