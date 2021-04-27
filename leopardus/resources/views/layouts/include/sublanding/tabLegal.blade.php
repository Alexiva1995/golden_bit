<div class="row pt-4 pb-4">
    <div class="col-6 col-sm-4 col-lg-3 d-flex align-items-start" style="position:sticky; top:100px">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link text-alt-blue {{($tipo == 'cookies') ? 'active' : ''}}" id="v-pills-home-tab"
                data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                aria-selected="true">Políticas de Cookies</a>
            <a class="nav-link text-alt-blue {{($tipo == 'documentacion') ? 'active' : ''}}" id="v-pills-profile-tab"
                data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                aria-selected="false">Documentación</a>
            <a class="nav-link text-alt-blue {{($tipo == 'avisolegal') ? 'active' : ''}}" id="v-pills-messages-tab"
                data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                aria-selected="false">Aviso Legal</a>
            <a class="nav-link text-alt-blue {{($tipo == 'privacidad') ? 'active' : ''}}" id="v-pills-settings-tab"
                data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                aria-selected="false">Privacidad</a>
        </div>
    </div>
    <div class="col-6 col-sm-8 col-lg-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade {{($tipo == 'cookies') ? 'show active' : ''}}" id="v-pills-home" role="tabpanel"
                aria-labelledby="v-pills-home-tab">
                <h5 class="text-alt-blue">
                    <strong>Cookies</strong>
                </h5>
                <small class="text-justify text-alt-gray">
                    <p>
                        Una cookie es un fichero que se descarga en su ordenador al acceder a determinada página web.
                        Las cookies permiten a una página web, entre otras cosas, almacenar y recuperar información
                        sobre los hábitos de navegación de un usuario o de su equipo y, dependiendo de la información
                        que contenga y de la forma en que utilice su equipo, pueden usarse para reconocer al usuario.
                    </p>
                    <h6>
                        ¿Qué tipo de cookies utiliza esta página web?
                    </h6>
                    <p>
                        <ul class="text-alt-gray text-justify list-orange">
                            <li>
                                Cookies propias: Son aquellas que se envían al equipo terminal del usuario desde un
                                equipo o dominio gestionado por el propio editor y desde el que se presta el servicio
                                solicitado por el usuario.
                            </li>
                            <li>
                                Cookies de tercero: Son aquellas que se envían al equipo terminal del usuario desde un
                                equipo o dominio que no es gestionado por el editor, sino por otra entidad que trata los
                                datos obtenidos a través de las cookies.
                            </li>
                        </ul>
                    </p>
                    <h6>
                        Revocación y eliminación de cookies.
                    </h6>
                    <p>
                        Usted puede permitir, bloquear o eliminar las cookies instaladas en su equipo mediante la
                        configuración de las opciones del navegador instalado en su navegador, en caso que no permita la
                        instalación de cookies en su navegador es posible que no pueda acceder a alguna de las secciones
                        de nuestra web.
                    </p>
                    <h6>
                        Cookies utilizadas
                    </h6>
                    <p>
                        De Google Analytica para obtener información estadística. Recopila información anónima sobre la
                        navegación por el sitio web para análisis estadísticos.
                        <br>
                        De Cloudflare para gestionar el CDN. Recopila información de la sesión.
                    </p>
                </small>
            </div>
            <div class="tab-pane fade {{($tipo == 'documentacion') ? 'show active' : ''}}" id="v-pills-profile"
                role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="row row-cols-1 row-cols-md-3 justify-content-center">
                    <div class="col">
                        <div class="card text-white bg-alt-orange h-100 pt-5 pb-5 rounded-alt text-center">
                            <div class="card-body">
                                <h5 class="card-title">Level UP</h5>
                                <a href="https://comunidadlevelup.com//assets/imgLanding/presentaciLevelUp.pdf" target="_blank" class="btn text-white" style="background: #1e777f;">Descargar PDF</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col">
                        <div class="card text-white bg-secondary h-100 pt-5 pb-5 rounded-alt text-center">
                            <div class="card-body">
                                <h6 class="card-title">Plan de Compensación</h6>
                                <a href="#" class="btn bg-alt-orange text-white">Descargar PDF</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="tab-pane fade {{($tipo == 'avisolegal') ? 'show active' : ''}}" id="v-pills-messages"
                role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <h5 class="text-alt-blue">
                    <strong>Aviso Legal</strong>
                </h5>
                <small class="text-justify text-alt-gray">
                    <p>
                        Al acceder, visualizar, crear una cuenta, usar la plataforma y/o realizar el pago de un paquete
                        en Level Up está aceptando las siguientes condiciones sin limitaciones ni excepciones. Si no
                        acepta las condiciones de este Aviso Legal, no deberá visualizar, ni registrarse, ni realizar
                        ninguna compra en la plataforma de Level Up. Usar cualquier funcionalidad de Level Up supondrá
                        la aceptación de este Aviso Legal y tendrá la misma validez que si hubiera firmado un contrato
                        físicamente.
                        <br>
                        El sitio web de Level Up proporciona gran diversidad de información, servicios y datos. El
                        usuario asume su responsabilidad en el uso correcto del sitio web. Esta responsabilidad se
                        extenderá a:
                        <ul class="text-alt-gray text-justify list-orange">
                            <li>
                                La veracidad de los datos aportados por el usuario en los formularios de Level Up para
                                el acceso a ciertos contenidos o servicios ofrecidos por la web.
                            </li>
                            <li>
                                El uso de la información, servicios y datos ofrecidos por Level Up contrariamente o
                                contraviniendo a lo dispuesto por las presentes condiciones, la ley, la moral, las
                                buenas costumbres o el orden público, o que de cualquier otro modo puedan suponer lesión
                                de los derechos de terceros o del propio funcionamiento del sitio web.
                            </li>
                        </ul>
                    </p>
                    <h6>Condiciones iniciales</h6>
                    <p>
                        Queremos que nuestra plataforma sea lo más abierta posible, pero también queremos que sea segura
                        y conforme a la ley, por este motivo, si quieres formar parte de la comunidad de Level Up, es
                        necesario que aceptes las siguientes restricciones básicas:
                        <ul class="text-alt-gray text-justify list-orange">
                            <li>
                                No debes haber sido inhabilitado anteriormente en una cuenta creada por ti en Level Up a
                                causa de una infracción de cualquiera de nuestras políticas o de la ley.
                            </li>
                        </ul>
                    </p>
                    <h6>La Plataforma</h6>
                    <p>
                        Los pagos deben ser del valor exacto que el paquete tiene y se realizan en Ethereum al monedero
                        que indique la plataforma y al cambio entre el Ethereum y el dólar estadounidense en el momento
                        de la transacción. En caso de que el usuario envié menos dinero de lo que vale el paquete que
                        desea adquirir la transacción será rechazada por la plataforma y el usuario deberá comunicarse
                        con el intermediario para efectuar la reclamación de su dinero, así mismo si paga más de lo
                        debido, la plataforma aceptara únicamente le valor exacto del paquete y el usuario deberá
                        comunicarse con el intermediario para reclamar el excedente.
                        <br>
                        Solo es posible abrir una cuenta por correo. Dada la relevancia para la identificación del
                        usuario con su cuenta en Level Up, los datos identificativos básicos (nombre, apellidos, lugar
                        de residencia y fecha de nacimiento) aclaramos que dichos datos podrán ser modificados posterior
                        al registro en caso de que el usuario haya incurrido en errores a la hora de facilitar los
                        datos.
                        <br>
                        Desde una misma cuenta en Level Up se pueden comprar diferentes paquetes, sin embargo, es
                        necesario aclarar que los beneficios que el usuario recibirá serán los asociados al último
                        paquete que haya comprado.
                        <br>
                        Los pagos y los movimientos se reflejan en la cuenta del usuario en dólares.
                        <br>
                        Los bonos producto del plan de referidos se pagan <mark>diariamente (salvo fines de semana y
                            festivos)</mark>
                        a las 22:00 hora colombiana. Por su parte el pago de los rendimientos producto de la
                        participación en el fondo de utilidades se realizará mensualmente teniendo en cuenta la fecha de
                        entrada de cada usuario a Level Up.
                        Estos pagos se realizarán a la billetera asociada por el usuario en los formularios de registro
                        de Level Up.

                    </p>
                    <h6>Comisiones</h6>
                    <p>
                        Level Up no cobra ningún tipo de comisión por transacción, las únicas comisiones que el usuario
                        debe pagar para realizar los pagos son las que el intermediario cobre por prestarle el servicio
                        de transferencia.
                    </p>
                    <h6>Asunción de riesgo</h6>
                    <p>
                        Recuerde que el mercado bursátil conlleva un alto nivel de riesgo y puede no ser apropiado para
                        determinadas personas. Tomar la decisión de invertir en el mercado bursátil es algo que se
                        meditar con calma y en especial es fundamental que exista una preparación previa, puesto que de
                        lo contrario se podrían experimentar perdidas inesperadas. Dado lo anterior se debe considerar
                        cuidadosamente sus objetivos de inversión, su nivel de experiencia y el riesgo que desea asumir.
                        Cualquier tipo de inversión que realice debe partir de la premisa de que nunca se debe invertir
                        un capital que no pueda permitirse perder. Siempre que se invierte en el mercado bursátil
                        debemos ser conscientes de todos los riesgos asociados a la inversión y si tiene alguna duda
                        buscar asesora por parte de un asesor financiero independiente.
                    </p>
                    <h6>Contenido</h6>
                    <p>
                        Ningún contenido de este documento, del sitio web de Level Up o cualquier documentación de la
                        plataforma supone una recomendación de inversión. La información no está dirigida a la
                        distribución o el uso por cualquier persona, en cualquier país o jurisdicción donde dicha
                        distribución o uso sean contrarios a las leyes o regulaciones locales.
                        <br>
                        Los conceptos del tipo "inversión", "fondo", "plan", "rentabilidad", "capital", “participación",
                        ”aportación", “interés" , ”comisión” , ”interés compuesto”, o similares no suponen una
                        declaración de inversión ni conllevan un significado más allá del meramente informativo.
                    </p>
                    <h6>Garantías</h6>
                    <p>
                        El sitio web de Level Up y su contenido se proporcionan "tal cual". No se ofrece ninguna
                        garanta, explícita o implícita, en relación con cualquier contenido, el sitio web, la exactitud
                        de cualquier información o cualquier derecho o licencia bajo este acuerdo incluyendo, sin
                        limitación, cualquier garanta implícita de comerciabilidad o adecuación para un propósito
                        particular. Level Up no representa ni garantiza que el sitio web o su contenido cumplan con sus
                        requisitos o que su uso sea ininterrumpido o libre de errores. Level Up no será responsable ante
                        usted o cualquier otra persona o entidad por cualquier daño general, punitivo, especial,
                        indirecto, consecuente o incidental, o pérdida de beneficios o cualquier otro daño, costo o
                        pérdida que surja de su uso del sitio web o de su contenido.
                    </p>
                    <h6>Plan de referidos y bono por participación en fondo de utilidades</h6>
                    <p>
                        Si recomienda Level Up debe realizarlo conforme a la información aportada por Level Up y en
                        ningún caso debe recomendarlo usando información no veraz o exagerada.
                        <br>
                        Para que un referido quede vinculado con la cuenta del patrocinador, es necesario, que este se
                        registre en Level Up aportando el código de referido que vincula con la cuenta.
                        <br>
                        Level Up pagara a sus usuarios por recomendar los paquetes que se ponen a disposición de la
                        comunidad siguiendo las siguientes distribuciones:
                        <ul class="text-alt-gray text-justify list-orange">
                            <li>
                                Si el usuario adquiere el plan Basic Level:
                                <br>
                                Level Up pagara el 10% de todas las ventas realizadas en el primer nivel del usuario.
                            </li>
                            <li>
                                Si el usuario adquiere el plan Plus Level:
                                <br>
                                Level Up pagara el 10% de todas las ventas realizadas en el primer nivel del usuario.
                                <br>
                                Level Up pagara el 2% de todas las ventas realizadas en el segundo nivel del usuario.
                                <br>
                                Level Up pagara el 3% de todas las ventas realizadas en el tercer nivel del usuario.
                            </li>
                            <li>
                                Si el ususario adquiere el Pro Level:
                                <br>
                                Level Up pagara el 10% de todas las ventas realizadas en el primer nivel del usuario.
                                <br>
                                Level Up pagara el 2% de todas las ventas realizadas en el segundo nivel del usuario.
                                <br>
                                Level Up pagara el 3% de todas las ventas realizadas en el tercer nivel del usuario.
                                <br>
                                Level Up pagara el 5% de todas las ventas realizadas en el cuarto nivel del usuario.
                            </li>
                        </ul>

                        El "bono por participación en el fondo de utilidades" supone el derecho que tiene cada usuario a
                        recibir el 4,5% mensual sobre el 60% del valor pagado por el paquete "Plus Level" o el 5%
                        mensual sobre el 65% del valor pagado por el paquete "Pro Level", según sea el caso.
                        <br>
                        El pago de este bono se realizará hasta que dichas rentabilidades mensuales sean equivalentes al
                        valor que elusuario pago por adquirir su último plan, siempre y cuando este sea un Plus Level o
                        un Pro Level, sin embargo Level Up podra cesar el pago de este bono de manera unilateral cuando
                        lo considere necesario sin que esto acarree sanción por incumplimiento a ninguna de las
                        compañías que conforman el portafolio ofrecido por Level Up,
                    </p>
                    <h6>Uso de la plataforma</h6>
                    <p>
                        El usuario entiende y acepta que Level Up pueda divulgar sus comunicaciones y actividades en
                        Level Up en respuesta a peticiones legales por parte de autoridades gubernamentales, incluidas
                        las peticiones de la ley patriótica norteamericana (U.S. Patriot Act), las órdenes judiciales,
                        garantas o citaciones o para proteger los derechos de Level Up. El usuario acepta que, en el
                        caso de que Level Up ejerza cualquiera de sus derechos aquí mencionados por cualquier razón,
                        Level Up no tendrá ninguna responsabilidad para con él.
                        <br>
                        Level Up se reserva el derecho a supervisar, prohibir, restringir, bloquear, suspender,
                        finalizar, borrar o interrumpir el acceso a cualquier usuario, en cualquier momento, sin previo
                        aviso, sin necesidad de especificar ninguna razón por ello y a su criterio. Level Up podrá
                        eliminar, borrar, bloquear, filtrar o restringir material por cualquier otro medio y al propio
                        criterio de Level Up. Así mismo Level Up podrá interrumpir el servicio o resolver de modo
                        inmediato la relación con el usuario, sin previo aviso o responsabilidad, si detecta un uso de
                        su plataforma o de cualquiera de los servicios ofertados en el mismo, contrario al presente
                        Aviso Legal. En este punto, su derecho de usar el Sitio Web cesara inmediatamente. Si se ha
                        realizado alguna compra y Level Up decide suspender el servicio de su plataforma y pagina web,
                        las compañías aliadas se comprometen a completar los servicios que se han vendido y se suspende
                        el pago de todos los bonos, sin que esto pueda acarrear ninguna sanción de ningún tipo.
                        <br>
                        Level Up no controla la utilización que los usuarios hacen de la plataforma, ni garantiza que lo
                        hagan de forma conforme al presente Aviso Legal. Level Up se reserva el derecho de dejar de
                        prestar cualquiera de los servicios que integran la plataforma, bastando para ello comunicarlo
                        en la pantalla de acceso al servicio. Se reserva, asimismo, el derecho de modificar
                        unilateralmente, en cualquier momento y sin previo aviso, las condiciones de la plataforma, así
                        como los servicios y las Normas de Uso de la Plataforma requeridas para su utilización.
                    </p>
                    <h6>Seguridad y acceso</h6>
                    <p>
                        Cuando se crea una cuenta en Level Up el usuario debe introducir la contraseña de acceso que
                        desea utilizar. El usuario debe guardar y custodiar la clave de acceso facilitada y asume, por
                        tanto, cuantos daños y/o perjuicios de todo tipo se deriven del quebrantamiento o revelación de
                        dicha contraseña. El usuario se compromete a no facilitar a nadie los datos de acceso a su
                        cuenta. El usuario podrá en cualquier momento cambiar las contraseñas desde su panel de
                        administración
                        <br>
                        En caso de que el usuario olvide la clave podrá recuperarla en cualquier momento usando el email
                        con el que se registró. En caso de no tener acceso al email utilizado será imposible recuperar
                        las claves y por tanto el acceso a la cuenta.
                        <br>
                        Es responsabilidad del usuario tener acceso al email utilizado en el registro a Level Up, dado
                        que todas las comunicaciones entre Level Up y el usuario se realizarán a través de esa dirección
                        de email.
                    </p>
                    <h6>Limitación de la responsabilidad</h6>
                    <p>
                        En el grado máximo permitido por ley, Level Up, no tiene ningún tipo de obligación o
                        responsabilidad en relación con todos aquellos daños y perjuicios indirectos, incidentales,
                        especiales, punitivos o consecuentes o con las responsabilidades que se originen o se relacionen
                        con el uso que usted haga de la plataforma o servicio, o de algún contenido provisto por o a
                        través de la plataforma o el servicio, aun cuando hayamos sido informados acerca de la
                        posibilidad de tales daños y perjuicios con antelación. Esta limitación se aplica a los daños y
                        perjuicios que se originan de:
                        <ul class="text-alt-gray text-justify list-orange">
                            <li>
                                Su uso o imposibilidad de uso de la plataforma y de acceso a los servicios.
                            </li>
                            <li>
                                El costo de obtención de productos o servicios sustitutos.
                            </li>
                            <li>
                                Fallos que pudieran producirse en las comunicaciones, incluido el borrado, transmisión
                                incompleta o retrasos en la remisión, no comprometiéndose tampoco a que la red de
                                transmisión esté operativa en todo momento.
                            </li>
                            <li>
                                El acceso no autorizado quebrantando las medidas de seguridad establecidas por Level Up
                                y la alteración o distribución del contenido que usted envía a través de la plataforma,
                                o el acceso a los mensajes o la remisión de virus informáticos.
                            </li>
                            <li>
                                El contenido de terceros puesto a su disposición a través de la plataforma.
                            </li>
                            <li>
                                Cualquier otro asunto relacionado con algún aspecto de la plataforma y el servicio,
                                incluido el sitio web, cualquier aplicación actual o futura, las comunicaciones por
                                correo electrónico y el contenido de Level Up en sitios de terceros.
                            </li>
                        </ul>
                        Aceptas que, aunque hacemos todo lo posible para evitar que suceda, Level Up no puede ser
                        considerado responsable por el mal uso o abuso de cualquier imagen o del contenido publicado en
                        Level Up.
                        <br>
                        El usuario reconoce expresamente que asume toda la responsabilidad relacionada con los riesgos
                        de la seguridad, privacidad y confidencialidad inherentes al envío de cualquier contenido a
                        través de Internet. Por su propia naturaleza, Internet y las páginas web no pueden protegerse de
                        manera absoluta de intentos de intromisión maliciosa o intencionada.
                        <br>
                        Level Up no controla los sitios de terceros ni de internet a través de los cuales decida enviar
                        información personal confidencial u otro contenido y, por ende, Level Up no asume ninguna
                        garanta frente a interceptaciones o compromisos con respecto a su información.
                        <br>
                        Level Up ha adoptado las mejores medidas de seguridad para la protección de los datos y la
                        información del usuario. No obstante, Level Up no puede
                        garantizar la invulnerabilidad absoluta de sus sistemas de seguridad, ni puede garantizar la
                        seguridad o inviolabilidad de dichos datos en su transmisión a través de la red.
                    </p>
                    <h6>Enlaces externos</h6>
                    <p>
                        Los enlaces a sitios externos que Level Up pone a disposición de los usuarios tienen por único
                        objeto facilitar a los mismos la búsqueda de la información disponible en Internet. Level Up no
                        ofrece ni comercializa los productos y servicios disponibles en los sitios enlazados ni asume
                        responsabilidad alguna por tales productos o servicios.
                        <br>
                        Level Up no se hace responsable del contenido de los sitios web a los que el usuario pueda
                        acceder a través de los enlaces establecidos en Level Up y declara que en ningún caso procederá
                        a examinar o ejercitar ningún tipo de control sobre el contenido de otros sitios de Internet.
                    </p>
                    <h6>Derechos</h6>
                    <p>
                        Level Up se reserva todos los derechos que no se hayan cedido de forma expresa.
                        <br>
                        No puede transferir ninguno de sus derechos u obligaciones en virtud de este acuerdo sin el consentimiento de Level Up.

                    </p>
                </small>
            </div>
            <div class="tab-pane fade {{($tipo == 'privacidad') ? 'show active' : ''}}" id="v-pills-settings"
                role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <h5 class="text-alt-blue">
                    <strong>Privacidad</strong>
                </h5>
                <small class="text-justify text-alt-gray">
                    <p>
                        Le informamos que cuando se registra en Level Up los datos que nos proporcione rellenando
                        cualquiera de los formularios de registro electrónico que aparece en esta página se recogerán en
                        ficheros para su tratamiento.
                        <br>
                        En cualquier momento usted podrá ejercer sus derechos de acceso, rectificación, cancelación y
                        oposición, a través de su panes de administración.
                        <br>
                        La recogida de sus datos es de carácter personal, se hace con la finalidad del correcto
                        funcionamiento del servicio.
                        <br>
                        Level Up se compromete a tratar de una manera absolutamente confidencial sus datos de carácter
                        personal y a utilizarlos solo y a utilizarlos solo para las finalidades indicadas. Así mismo le
                        informamos que Level Up tiene implantadas las medidas de seguridad de tipo técnico y
                        organizativas necesarias para garantizar la seguridad de sus datos de carácter personal y evitar
                        la alteración, la perdida y el tratamiento y/o accedo no autorizados, teniendo en cuenta el
                        estado de la tecnología, la naturaleza de los datos almacenados y los riesgos a que están
                        expuestos, provenientes de la acción humana o del medio físico natural.
                    </p>
                </small>
            </div>
        </div>
    </div>
</div>