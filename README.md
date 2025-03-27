---

# 📌 Configuração do Ambiente  

Para que o código funcione corretamente, você precisará configurar o ambiente, incluindo a conta que enviará os e-mails e o banco de dados.  

## 🔹 Configuração do Banco de Dados  

1. Baixe e instale o **MySQL Workbench**.  
2. Ative o **MySQL** no **XAMPP**.  
3. Abra o **MySQL Workbench**, cole e execute o código SQL abaixo:  

```sql
CREATE DATABASE minezin;

USE minezin;

CREATE TABLE `registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(16) NOT NULL,
  `email` varchar(329) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `original` tinyint(1) NOT NULL,
  `bedrock` tinyint(1) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(512) DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `confirmacao_de_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(16) NOT NULL,
  `email` varchar(329) NOT NULL,
  `code_hash` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `attempts` int(11) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `2fa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `code_hash` varchar(64) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `attempts` varchar(64) DEFAULT NULL,
  `used_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `2fa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

---

## 🔹 Configuração do Envio de E-mails  

1. No **XAMPP**, clique em **Explorer** e abra a pasta **sendmail**.  
2. Edite o arquivo `sendmail.ini` e altere os seguintes valores:  

   ```ini
   smtp_server=smtp.gmail.com
   smtp_port=587
   auth_username="testesdeemail123456@gmail.com"
   auth_password="byflkmahxrubrybm"
   ```

3. Agora, volte para a pasta **XAMPP**, abra a pasta **php** e edite o arquivo `php.ini`:  

   - Encontre `SMTP` e altere para:  
     ```ini
     SMTP=smtp.gmail.com
     ```
   - Encontre `smtp_port` e altere para:  
     ```ini
     smtp_port=587
     ```
   - Encontre `sendmail_from` e altere para:  
     ```ini
     sendmail_from="testesdeemail123456@gmail.com"
     ```
   - Encontre `sendmail_path` e altere para:  
     ```ini
     sendmail_path="C:\xampp\sendmail\sendmail.exe -t -i"
     ```

   > Salve e feche os arquivos.  

---

## 🔹 Configuração dos Arquivos do Projeto  

1. Copie todos os arquivos do repositório para uma pasta dentro da pasta **htdocs** do XAMPP.  

2. No XAMPP, ative os serviços:  
   - **Apache**  
   - **MySQL**  

3. No navegador, acesse:  
   ```url
   localhost/<nome_da_pasta_dentro_de_htdocs>
   ```

Agora, o código deve estar funcionando corretamente! 🚀

nota: readme.md polido por chat gpt
