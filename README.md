# Sobre o projeto

O projeto em questão se trata de um multiconector de banco de dados, oferecendo uma estrutura pronta de Active Records para os bancos de dados mais utilizados: MySQL, PostgreSQL e SQL Server. Além disso, permite a conexão com outros bancos de dados, expandindo suas possibilidades.

**Tecnologias utilizadas:**
* PHP 8+

## Clonando o Repositório
**Comece clonando o repositório do projeto no seu diretório local:**
```bash
git clone _url_
```

## Instalando as Dependências
**Em seguida, instale as dependências do projeto utilizando o Composer:**
```bash
composer install
```

## Configurando o Ambiente

**Configure as variáveis de ambiente, incluindo as credenciais do banco de dados.**
**Caso for pgsql, sqlsrv ou mysql.**
```bash
define('DB_CONNECTION', 'mysql'); 
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_DATABASE', 'db_teste');
define('DB_USERNAME', 'usuario');
define('DB_PASSWORD', 'senha');
```

**Caso for outro banco de dados. (exemplo com banco Oracle, mas pode ser qualquer um relacional para testar)**
```bash
define('NEW_DB_CONNECTION', 'pattern');
define('NEW_DB_DNS', "oci:dbname=(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))(CONNECT_DATA=(SID=db_teste)))");
define('NEW_DB_USERNAME', 'usuario');
define('NEW_DB_PASSWORD', 'senha');
```

**Opções de Configuração**
```bash
define('COLUMNS_BD', 'NATURAL'); // LOWER / NATURAL / UPPER
```
1. COLUMNS_BD: Define como as colunas das tabelas serão retornadas:
	* LOWER: Retorna em minúsculas.
	* NATURAL: Retorna como está no banco de dados.
	* UPPER: Retorna em maiúsculas.


```bash
define('RETURN_BD', 'ARRAY'); // ARRAY / OBJECT
```
2. RETURN_BD: Define o formato de retorno dos dados das tabelas:
	* ARRAY: Retorna como um array associativo.
	* OBJECT: Retorna como um objeto.

## Model

**Para criar um model, acesse o diretório app/database/Models. Crie um novo arquivo PHP e defina a classe do seu model, extendendo a classe Model e setando o nome da tabela na variável $table:**

```bash

<?php

namespace app\database\Models;

use app\database\ActiveRecords\Model;

class UserModel extends Model
{
	protected $table = 'usuarios';
}
```

**Observações:**
* Substitua usuarios pelo nome real da sua tabela.
* Você pode criar quantos models forem necessários, seguindo a mesma estrutura.

## CRUD
**Neste sistema, ao instanciar o model, poderá realizar as consultas da seguinte maneira:**

* SELECT (retorna dados da tabela)
```bash
	$user = new UserModel;
	$user->select();
```

* INSERT (passa os dados a serem preenchidos) (retorna o id inserido)
```bash
	$user = new UserModel;
	$user->insert([
		'nome' => 'Adm',
		'email' => 'usuario@gmail.com',
		'senha' => '12345',
	]);
```

* UPDATE (passa os dados a serem atualizados e a condição) (retorna a quantidade de linhas afetadas)
```bash
	$user->update(['nome' => 'Supervisor'], ['id' => 1]);
```

* DELETE (passa uma condição para o delete) (retorna a quantidade de linhas afetadas)
```bash
	$user->delete(['id' => 1]);
```

* QUERY (literalmente passa uma query)
```bash
	$user->sql('SELECT * FROM usuarios');
```

**Observações:**
* INSERT, SELECT, UPDATE e DELETE está disponível apenas para banco de dados pgsql, sqlsrv ou mysql, setados em:
```bash
define('DB_CONNECTION', 'mysql'); 
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_DATABASE', 'db_teste');
define('DB_USERNAME', 'usuario');
define('DB_PASSWORD', 'senha');
```
* Para demais bancos, as querys terão de ser resolvidas na função sql;
```bash
	$user->sql('SELECT * FROM usuarios');
```

---
## Considerações Finais

Essa é apenas uma estrutura básica usando Design Patterns, Obrigada pelo apoio!
