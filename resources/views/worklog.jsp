<%@ page contentType="text/html;charset=UTF-8" language="java"
        %><%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"
        %><%@ taglib prefix="t" uri="http://tiles.apache.org/tags-tiles"
        %><%@ taglib prefix="fn" uri="http://java.sun.com/jsp/jstl/functions"
        %><%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt"
        %>
<section class="content-header">
  <h1>
      <a href="worklog.htm?projectId=${param.projectId}"><span class="fa fa-refresh"></span></a>
      ${model.project.name} <small><a href="${model.project.pageName}.htm?projectId=${model.project.stringId}&id=${model.project.stringId}&cmd=edit">Перейти в проект</a></small>
  </h1>
</section>

<section class="content">

<div class="row clearfix">
    <div class="col-md-12">

        <!-- фильтр -->
        <div class="row clearfix">
           <div class="col-md-3">Тип записи</div>
        </div>

        <form action="worklog.htm">
        <input type="hidden" name="projectId" value="${model.project.stringId}"/>
        <div class="row clearfix" style="margin-bottom:5px;">
           <div class="col-md-3">
              <select id="filter_flag_id" name="filter_flag_id" class="form-control">
                <option value="all">Все типы</option>
                <c:forEach items="${model.worklogFlagList}" var="f">
                    <option value="${f.name}" <c:if test="${sessionScope.worklog_filter.flag.name eq f.name}">selected="true"</c:if>>${f.name} - ${f.title}</option>
                </c:forEach>
              </select>
           </div>
           <div class="col-md-9">
              <button class="btn btn-default btn-flat" type="submit">
                 <i class="fa fa-filter"></i>&nbsp;Применить фильтр
              </button>
           </div>
        </div>
        </form>

    </div>
</div>

<div class="row clearfix">
    <div class="col-md-12 column">

        <div class="box">
            <div class="box-body table-responsive no-padding">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Время</th>
                            <th>Действие</th>
                            <th>Описание</th>
                        </tr>
                    </thead>
                    <tbody>

                      <c:choose>
                         <c:when test="${fn:length(model.logList) gt 0}">
                            <c:forEach items="${model.logList}" var="r" varStatus="rs">
                              <tr <c:choose>
                                     <c:when test="${r.flag.name eq 'INFO'}">class="text-aqua"</c:when>
                                     <c:when test="${r.flag.name eq 'WARN'}">class="text-yellow"</c:when>
                                     <c:when test="${r.flag.name eq 'ERR'}">class="text-red"</c:when>
                                  </c:choose>>
                                  <td style="width: 40px;" class="text-center">
                                      <c:choose>
                                         <c:when test="${r.flag.name eq 'OK'}"><span class="text-green fa fa-check-circle"></span></c:when>
                                         <c:when test="${r.flag.name eq 'INFO'}"><span class="text-aqua fa fa-info-circle"></span></c:when>
                                         <c:when test="${r.flag.name eq 'WARN'}"><span class="text-yellow fa fa-warning"></span></c:when>
                                         <c:when test="${r.flag.name eq 'ERR'}"><span class="text-red fa fa-minus-circle"></span></c:when>
                                         <c:otherwise>&nbsp;</c:otherwise>
                                      </c:choose>
                                  </td>
                                  <td style="width: 120px;">
                                       <fmt:formatDate value="${r.createdTime}" pattern="yyyy-MM-dd HH:mm"/>
                                  </td>
                                  <td style="width: 300px;">
                                      ${r.operation}
                                  </td>
                                  <td>
                                      ${r.data['text']}
                                  </td>
                              </tr>
                            </c:forEach>
                         </c:when>
                         <c:otherwise>
                             <tr>
                                 <td colspan="4">
                                     <div class="alert alert-dismissable alert-info">
                                       <button type="button" class="close" data-dismiss="alert">×</button>
                                       Журнал пуст
                                     </div>
                                 </td>
                             </tr>
                         </c:otherwise>
                      </c:choose>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- //BOX -->

    </div>
</div>

</section>

