        // 页面加载完成后执行
        function onPageLoad() {
            updateTitle();
            document.getElementById('memberLoginForm').addEventListener('submit', handleFormSubmit);
        }

        // 表单提交事件处理
        async function handleFormSubmit(event) {
            event.preventDefault(); // 阻止表单默认提交行为

            // 获取表单元素
            const form = document.getElementById('memberLoginForm');
            // 获取邮箱和密码
            const email = form.querySelector('input[name="account"]').value;
            const password = form.querySelector('input[name="password"]').value;

            try {
                // 发送 POST 请求到后端的 login.php
                const response = await fetch('/api/login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });
                // 解析响应数据为 JSON
                const data = await response.json();

                // 根据后端响应进行判断
                if (response.ok) {
                    // 登录成功
                     alert(`Welcome ${data.user.firstname} ${data.user.lastname}`);
                } else {
                    // 登录失败
                    alert(`Login failed: ${data.error}`);
                }
            } catch (error) {
                // 请求过程中发生错误
                console.error('Fetch error:', error);
                alert('An error occurred during login.');
            }
        }
       // DOMContentLoaded事件，确保DOM加载完成后执行脚本
        document.addEventListener('DOMContentLoaded', onPageLoad);