<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>All Pages</title>
    <style>
      table {
        font: 11px/24px Verdana, Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        float: center;
        }
      .date {
        text-align: center;
        margin-bottom: 10px;
      }

      th {
        padding: 0 0.5em;
        text-align: left;
        }

      tr.yellow td {
        border-top: 1px solid #FB7A31;
        border-bottom: 1px solid #FB7A31;
        background: #FFC;
        }

      td {
        border-bottom: 1px solid #CCC;
        padding: 0 0.5em;
        }

      td.adjacent {
        border-left: 1px solid #CCC;
        text-align: center;
        }
    </style>
  </head>
  <body>

    <div class="date">Created At: {{ $date }}</div>

    <table align="center">
      <tr class="yellow">
        <td class="adjacent">Page Title</th>
        <td class="adjacent">Slug</th>
        <td class="adjacent">Parent Page</th>
        <td class="adjacent">Author</th>
        <td class="adjacent">Status</th>
        <td class="adjacent">Updated At</th>
      </tr>
      <tbody>
        @foreach($data as $page)
        <tr>
          <td class="adjacent">{{ $page->title }}</td>
          <td class="adjacent">{{ $page->slug }}</td>
          <td class="adjacent">{{ ($page->parent == 0) ? 'No Parent' : $page->title }}</td>
          <td class="adjacent">{{ $page->user->name }}</td>
          <td class="adjacent">{{ ($page->active == 1) ? 'Active' : 'In Active' }}</td>
          <td class="adjacent">{{ $page->updated_at }}</td>
        </tr>
        @endforeach
      </tbody>
      
    </table>
  </body>
</html>