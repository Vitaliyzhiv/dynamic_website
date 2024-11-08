document.querySelectorAll('#content').forEach((element) => {
    ClassicEditor
        .create(element, {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'fontSize',
                'fontFamily',
                'fontColor',
                '|',
                'link',
                'bulletedList',
                'numberedList',
                'blockQuote'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
            },
            fontFamily: {
                options: [
                    'default',
                    'Ubuntu, Arial, sans-serif',
                    'Ubuntu Mono, Courier New, Courier, monospace'
                ]
            },
            fontColor: {
                colorPicker: {
                    // Use 'hex' format for output instead of 'hsl'.
                    format: 'hex'
                }
            },
        })
        .catch(error => {
            console.log(error);
        });

});

// $(document).ready(function () {
$(document).ready(function (element) {

    $('.delete-category a').click(function (e) {
        e.preventDefault();
        const categoryId = $(this).data('id');
        const postElement = $(this).closest('.topic'); // Находим родительский элемент для удаления

        if (confirm('Вы уверены, что хотите удалить эту категорию ?')) {
            $.ajax({
                url: 'http://localhost/dynamic_website/admin/topics/delete_topic.php',
                type: 'POST',
                data: { delete_id: categoryId },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        postElement.remove(); // Удаляем элемент категории из DOM
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Произошла ошибка при удалении категории.');
                }
            });
        }
    });

    $('.delete-user a').click(function (e) {
        e.preventDefault();
        const userId = $(this).data('id');
        const userElement = $(this).closest('.user'); // Находим родительский элемент для удаления

        if (confirm('Вы уверены, что хотите удалить этого пользователя ?')) {
            $.ajax({
                url: 'http://localhost/dynamic_website/admin/users/delete_user.php',
                type: 'POST',
                data: { delete_id: userId },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        userElement.remove(); // Удаляем элемент категории из DOM
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Произошла ошибка при удалении пользователя.');
                }
            });
        }
    });

    $('.delete-post a').click(function (e) {
        e.preventDefault();
        // Забираем id у ссылки 
        const postId = $(this).data('id');
        const postElement = $(this).closest('.post'); // Находим родительский элемент для удаления

        if (confirm('Вы уверены, что хотите удалить этот пост ?')) {
            $.ajax({
                url: 'http://localhost/dynamic_website/admin/posts/delete_post.php',
                type: 'POST',
                data: { delete_id: postId },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        postElement.remove(); // Удаляем элемент категории из DOM
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Произошла ошибка при удалении поста');
                }
            });
        }
    });

    $('.post-status a').click(function (e) {
        e.preventDefault();
        // Забираем id у ссылки
        const postId = $(this).data('id');
        // Забираем статус у ссылки
        const statusId = $(this).data('status');
        console.log(statusId);
        // Устанавливаем новый статус реверсным присвоением нового значения
        const newStatusId = statusId === 1 ? 0 : 1;
        console.log(newStatusId);
        // Устанавливаем новый текст статуса
        const newStatusText = newStatusId === 1 ? 'Опубликовать' : 'В черновик';
        console.log(newStatusText);
        const link = $(this); // Ссылка на элемент

        if (confirm(`Вы уверены, что хотите ${newStatusText} ?`)) {
            $.ajax({
                url: 'http://localhost/dynamic_website/admin/posts/update_status.php',
                type: 'POST',
                data: {
                    update_id: postId,
                    new_status: newStatusId
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        // Обновляем текст в ссылке на новый статус
                        if (newStatusId === 1) {
                            link.text('В черновик');
                        } else {
                            link.text('Опубликовать');
                        }
                        // Обновляем статус поста в ДОМ
                        link.data('status', newStatusId);   
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert(`Произошла ошибка при попытке ${newStatusText} ?`);
                }
            });
        }
    });


});


//     const target = $(e.target).closest('a');
//     if (target.length) {
//         e.preventDefault();
//         var categoryId = target.data('id');
//     }

//     if (confirm('Вы уверены, что хотите удалить категорию?')) {
//         $.ajax({
//             url: 'http://localhost/dynamic_website/app/controllers/topics.php',
//             type: 'POST',
//             dataType: 'json', // Встановлюємо тип даних для відповіді
//             data: { 'catId': categoryId },
//             success: function (response) {
//                 if (response.success) {
//                     alert(response.message);
//                     // Видаляємо рядок категорії з DOM
//                     target.closest('.post').remove();
//                 } else {
//                     alert('Ошибка при удалении категории: ' + (response.message || 'Неизвестная ошибка'));
//                 }
//             },
//             error: function (xhr, status, error) {
//                 alert('Произошла ошибка: ' + error);
//             }
//         });
//     }
// });







