<link type="text/css" rel="stylesheet" href="View/css/modificaCliente.css" />


<div id="contenitoreForm">
        
        <h1>Modifica informazioni</h1>
        
        <form name="modificaCliente" action="modificaCliente.php" method="post">
            
            <table>
                    <tr>
                        <td>Nome</td>
                        <td> <input type="text" id="nome" required></td>
                    </tr>

                    <tr>
                        <td>Cognome</td>
                        <td> <input type="text" id="cognome" required></td>
                    </tr>

                    <tr>
                        <td>Data di nascita</td>
                        <td> <input type=date id="dataNascita" required></td>
                    </tr>

                    <tr>
                        <td>Sesso</td>
                        <td> M<input type="radio" id="maschio"> F<input type="radio" id="femmina"></td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td> <input type="text" id="email" required></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td> <input type="password" id="password1" required></td>
                    </tr>

                    <tr>
                        <td>Conferma Password</td>
                        <td> <input type="password" id="password2" required></td>
                    </tr>

                    <tr>
                        <td><input type=submit id="submit" value="Applica cambiamenti"><td/>
                    </tr>

                </table>

        </form>
    </div>