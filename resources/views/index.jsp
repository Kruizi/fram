<%@ page contentType="text/html;charset=UTF-8" language="java"
        %><%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"
        %><%@ taglib prefix="t" uri="http://tiles.apache.org/tags-tiles"
        %><%@ taglib prefix="fn" uri="http://java.sun.com/jsp/jstl/functions"
        %>

<c:if test="${(fn:length(requestScope.error) gt 0) or (fn:length(param.msg) gt 0)}">

    <div class="modal" id="messagePopup">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button onClick="$('#messagePopup').hide()" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            <c:if test="${(fn:length(requestScope.ok) gt 0) or (param.msg eq 'ok')}">
                <h4 class="modal-title text-green">Сообщение</h4>
            </c:if>
            <c:if test="${(fn:length(requestScope.error) gt 0) or (param.msg eq 'err')}">
                <h4 class="modal-title text-red">Ошибка</h4>
            </c:if>

          </div>
          <div class="modal-body">
             <p>
                <c:if test="${fn:length(requestScope.ok) gt 0}">
                   <c:out value="${requestScope.ok}" escapeXml="false"/>
                </c:if>
                <c:if test="${fn:length(requestScope.error) gt 0}">
                   <c:out value="${requestScope.error}" escapeXml="false"/>
                </c:if>
                <c:if test="${param.msg eq 'ok'}">
                   <c:out value="${sessionScope.ok}" escapeXml="false"/>
                </c:if>
                <c:if test="${param.msg eq 'err'}">
                   <c:out value="${sessionScope.error}" escapeXml="false"/>
                </c:if>
             </p>
          </div>
          <div class="modal-footer">
            <button onClick="$('#messagePopup').hide()" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
        $(window).load(function() {
            $('#messagePopup').show();
        });
    </script>

</c:if>

<div class="bg-content">

  <div class="container">

      <div class="row clearfix">
          <div class="col-md-3"></div>
          <div class="col-md-6">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab_1">Вход</a></li>
                        <li class=""><a data-toggle="tab" href="#tab_2">Регистрация</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab_1" class="tab-pane active">


                              <form role="form" action="index.htm" method="post">
                                  <input type="hidden" name="cmd" value="signin"/>

                                      <c:choose>
                                         <c:when test="${not empty sessionScope.logged_user}">

                                            <div class="box">
                                                <div class="box-header">
                                                    <h3 class="box-title">ВОЙТИ</h3>
                                                </div>
                                                <div class="box-body text-center">
                                                      <img src="${model.userPhoto}" class="img-circle" style="border: 1px solid #888" alt="${sessionScope.logged_user.data['fname']}" width="128" height="128"/>
                                                      <br/>
                                                      <div>
                                                        ${sessionScope.logged_user.data['name']} ${sessionScope.logged_user.data['lname']}
                                                      </div>
                                                      <p><a href="index.htm?cmd=logout">выйти</a></p>
                                                      <a href="projects.htm" class="btn btn-primary w100 bld">ВОЙТИ</a>
                                                </div><!-- /.box-body-->
                                            </div>

                                         </c:when>
                                         <c:otherwise>

                                            <div class="box">
                                                <div class="box-header">
                                                    <h3 class="box-title">ВХОД</h3>
                                                </div>
                                                <div class="box-body">

                                                      <div class="input-group">
                                                          <span class="input-group-addon">
                                                              <i class="fa fa-envelope"></i>
                                                          </span>
                                                          <input name="u" placeholder="Ваш e-mail" class="form-control" type="text" required="required">
                                                      </div>
                                                      <br/>
                                                      <div class="input-group">
                                                          <span class="input-group-addon">
                                                              <i class="fa fa-keyboard-o"></i>
                                                          </span>
                                                          <input name="k" placeholder="Пароль" class="form-control" type="password" required="required">
                                                      </div>
                                                      <div class="checkbox">
                                                          <label>
                                                              <div style="float: left">
                                                                  <input name="rm" type="checkbox" checked="true" style="position: absolute; opacity: 0;">
                                                              </div>&nbsp;Запомнить меня
                                                          </label>
                                                      </div>
                                                      <p class="text-center"><a href="restorepwd.htm">я забыл пароль</a></p>
                                                      <div>
                                                          <button type="submit" class="btn btn-primary w100 bld" onclick="yaCounter25024184.reachGoal('signin'); return true;">НАЧАТЬ РАБОТУ</button>
                                                      </div>

                                                </div><!-- /.box-body-->
                                            </div>

                                         </c:otherwise>
                                      </c:choose>

                              </form>


                        </div>
                        <div id="tab_2" class="tab-pane">


                              <div class="box">
                                  <div class="box-header">
                                      <h3 class="box-title">РЕГИСТРАЦИЯ</h3>
                                  </div>
                                  <div class="box-body">

                                      <form role="form" action="index.htm" method="post">
                                          <input type="hidden" name="cmd" value="signup"/>

                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                              <input name="e" placeholder="Ваш e-mail" class="form-control" type="text" required="required">
                                          </div>
                                          <br/>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                              <input name="p" placeholder="Ваш пароль" class="form-control" type="text" required="required">
                                          </div>
                                          <!--
                                          <div class="checkbox">
                                              <label>
                                                  <div style="float: left">
                                                      <input name="subsme" type="checkbox" checked="true" style="position: absolute; opacity: 0;">
                                                  </div>&nbsp;я подписываюсь на новости
                                              </label>
                                          </div>
                                          -->
                                          <div style="margin-bottom: 13px">&nbsp;</div>
                                          <div>
                                              <button type="submit" class="btn btn-primary w100 bld">ЗАРЕГИСТРИРОВАТЬСЯ</button>
                                          </div>
                                      </form>

                                  </div><!-- /.box-body-->
                              </div>


                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div>


          </div>
          <div class="col-md-3"></div>
      </div>

      <div class="text-center" style="margin-top:5px;">
         <a href="files/websellers-yandex-direct.pdf">Руководство пользователя</a>
      </div>

  </div>

</div>

