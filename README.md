# Endpoints API REST

## GET

### Listar a todos los usuarios (Solo administradores)
- **Ruta**: `http:://127.0.0.1:9090/admin/all`

- **Resolución**: Devolverá todos los datos de los usuarios si se ha autenticado correctamente y es administrador.


### Listar a un usuario (Solo administradores)
- **Ruta**: `http:://127.0.0.1:9090/admin/user/{id}`
- **JSON**:
    ```json
    {
        "id": "xxxx",

    }
    ```
- **Resolución**: Devolverá los datos de un usuario en concreto si se ha autenticado correctamente y es administrador.


### Listar a todas las partidas
- **Ruta**: `http:://127.0.0.1:9090/partida/consultar`
  
- **Resolución**: Devolverá los datos de todas las partidasse ha autenticado correctamente.


### Listar a todas las partidas de un usuario concreto
- **Ruta**: `http:://127.0.0.1:9090/partida/consultar/usuario`
- **JSON**:
      ```json
    {
        "id_usuario": "xxxx",

    }
    ```
- **Resolución**: Devolverá los datos de todas las partida si se ha autenticado correctamente.


### Consultar ranking de victorias 
- **Ruta**: `http:://127.0.0.1:9090/partida/ranking/ganadas`

- **Resolución**: Devolverá una lista de usuarios ordenada por victorias si se ha autenticado correctamente.


### Consultar ranking de perdidas 
- **Ruta**: `http:://127.0.0.1:9090/partida/ranking/perdidas`

- **Resolución**: Devolverá una lista de usuarios ordenada por derrotas si se ha autenticado correctamente.


### Consultar ranking de empates 
- **Ruta**: `http:://127.0.0.1:9090/partida/ranking/empates`

- **Resolución**: Devolverá una lista de usuarios ordenada por empates si se ha autenticado correctamente.


### Consultar ranking de jugadas 
- **Ruta**: `http:://127.0.0.1:9090/partida/ranking/jugadas`

- **Resolución**: Devolverá una lista de usuarios ordenada por partidas jugadas si se ha autenticado correctamente.


### Listar a todas las manos jugadas
- **Ruta**: `http:://127.0.0.1:9090/manos`

- **Resolución**: Devolverá los datos de todas las manos si se ha autenticado correctamente.


### Listar a todas las manos jugadas por un usuario concreto
- **Ruta**: `http:://127.0.0.1:9090/manos/usuario`
      ```json
    {
        "idUsuario": "xxxx",

    }
    ```
- **Resolución**: Devolverá los datos de todas las manos de un usuario concreto si se ha autenticado correctamente.


### Listar a todas las manos jugadas en una partida concreta
- **Ruta**: `http:://127.0.0.1:9090/manos/partida`
      ```json
    {
        "id_partida": "xxxx",

    }
    ```
- **Resolución**: Devolverá los datos de todas las manos de una partida concreta si se ha autenticado correctamente.


### Estadisticas de manos ganadadoras
- **Ruta**: `http:://127.0.0.1:9090/estadisticas/ganadas`

- **Resolución**: Devolverá una lista de las manos ordenadas por mayor numero de victorias y su porcentaje de victorias si se ha autenticado correctamente.


### Estadisticas de manos perdedoras
- **Ruta**: `http:://127.0.0.1:9090/estadisticas/perdidas`

- **Resolución**: Devolverá una lista de las manos ordenadas por mayor numero de derrotas y su porcentaje de derrotas si se ha autenticado correctamente.


### Estadisticas de manos empatadas
- **Ruta**: `http:://127.0.0.1:9090/estadisticas/empatadas`

- **Resolución**: Devolverá una lista de las manos ordenadas por mayor numero de empates y su porcentaje de empates si se ha autenticado correctamente.


### Estadisticas de manos jugadas
- **Ruta**: `http:://127.0.0.1:9090/estadisticas/jugadas`

- **Resolución**: Devolverá una lista de las manos ordenadas por mayor numero de partidas jugadas y su porcentaje de partidas jugadas si se ha autenticado correctamente.


## POST

### Insertar un usuario (Solo administradores)
- **Ruta**: `http:://127.0.0.1:9090/admin/user`
- **JSON**:
    ```json
    {
        "newNombre": "xxxx",
        "newPassword": "xxxx",
        "newEmail": "xxxxx"
    }
    ```
- **Resolución**: Insertara el usuario en la base de datos con los demas campos por defecto si se ha autenticado correctamente y es administrador.



### Crear una nueva partida 
- **Ruta**: `http:://127.0.0.1:9090/partida/new`
- **JSON**:
    ```json
    {
        "usuario": "xxxx",
        "usuario2": "xxxx"
    }
    ```
- **Resolución**: Creara una nueva partida a la que se le asignaran los usuarios participantes si se ha autenticado correctamente.

### Login
- **Ruta**: `http:://127.0.0.1:9090/login`
- **JSON**:
    ```json
    {
        "email": "xxxx",
        "password": "xxxx"
    }
    ```
- **Resolución**: Creara y devolvera un nuevo token de acceso si los datos introducidos son correctos


### Registro
- **Ruta**: `http:://127.0.0.1:9090/register`
- **JSON**:
    ```json
    {
        "email": "xxxx",
        "password": "xxxx",
        "confirm_password": "xxxx",
        "nombre":"xxxxx"
    }
    ```
- **Resolución**: Registrara un nuevo usuario si cumple con los requisitos requeridos.

### Logout
- **Ruta**: `http:://127.0.0.1:9090/logout`
- **JSON**:
    ```json
    {
        "email": "xxxx",
        "password": "xxxx",
        
    }
    ```
- **Resolución**: Revocara todos los tokens de acceso de un  usuario.

## PUT

### Actualizar el nombre de un usuario (Solo administradores)
- **Ruta**: `http:://127.0.0.1:9090/admin/update/username`
- **JSON**:
    ```json
    {
        "newNombre": "xxxxx",
        "idUpdate": "xxxxx"
    }
    ```

- **Resolución**: Cambiara el nombre de usuario al que le corresponda el id indicado

### Actualizar el email de un usuario (Solo administradores)
- **Ruta**: `http:://127.0.0.1:9090/admin/update/password`
- **JSON**:
    ```json
    {
        "newPassword": "xxxxx",
        "idUpdate": "xxxxx"
    }
    ```

- **Resolución**: Cambiara la contraseña de usuario al que le corresponda el id indicado


### Actualizar el rol de un usuario (Solo administradores)
- **Ruta**: `http:://127.0.0.1:9090/admin/update/rol`
- **JSON**:
    ```json
    {
        "newRol": "xxxxx",
        "idUpdate": "xxxxx"
    }
    ```

- **Resolución**: Cambiara el rol de usuario al que le corresponda el id indicado


### Jugar una ronda de una partida
- **Ruta**: `http:://127.0.0.1:9090/partida/jugar`
- **JSON**:
    ```json
    {
        "id_partida": "xxxxx",
        "mano_usuario1": "xxxxx",
        "mano_usuario2": "xxxxx"
    }
    ```

- **Resolución**: Insertara en la base de datos la mano correspondiente a la partida indicada junto con lo elegido por los usuarios para jugar


## DELETE

### Eliminación de Usuario (Solo Administradores)
- **Ruta**: `http:://127.0.0.1:9090`
- **JSON**:
    ```json
    {
        "id_usuario": "xxxxx",
    
    }
    ```
- **Resolución**: Si el usuario es correcto y administrador, eliminará de la base de datos al usuario con el id indicado.
