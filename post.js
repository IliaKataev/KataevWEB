const getPostIdFromURL = () => {
    const params = new URLSearchParams(window.location.search)
    return params.get('id')
}

const fetchPostById = async (id) => {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}`)
        if (!response.ok) throw new Error(`Ошибка загрузки поста: ${response.status}`)
        return await response.json()
    } catch (error) {
        console.error(error)
        renderError('Не удалось загрузить пост.')
    }
}

const fetchCommentsByPostId = async (id) => {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}/comments`)
        if (!response.ok) throw new Error(`Ошибка загрузки комментариев: ${response.status}`)
        return await response.json()
    } catch (error) {
        console.error(error)
        renderError('Не удалось загрузить комментарии.')
    }
}

const renderPost = (post) => {
    const postContainer = document.getElementById('post')
    if (!post) return
    postContainer.innerHTML = `
        <h1>Пост</h1>
        <h1>${post.title}</h1>
        <p>${post.body}</p>
    `
}

const renderComments = (comments) => {
    const container = document.querySelector('[data-comments]')
    if (!comments || !Array.isArray(comments)) return
    container.innerHTML = comments.map(comment => `
        <div class="comment">
            <h3>${comment.name}</h3>
            <p><strong>${comment.email}</strong></p>
            <p>${comment.body}</p>
        </div>
    `).join('')
}

const renderError = (message) => {
    const postContainer = document.getElementById('post')
    postContainer.innerHTML = `<p class="error">${message}</p>`
}

const init = async () => {
    const postId = getPostIdFromURL()
    if (!postId) {
        renderError('ID поста не указан в URL')
        return
    }

    const post = await fetchPostById(postId)
    renderPost(post)

    const comments = await fetchCommentsByPostId(postId)
    renderComments(comments)
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init)
} else {
    init()
}
