<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instagram Promotional Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1>Post Promotional Image to Instagram</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('instagram.publish') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Caption</label>
                <textarea name="caption" class="form-control" rows="3" maxlength="2200"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image (JPG/PNG)</label>
                <input type="file" name="image" accept="image/*" class="form-control" required>
            </div>
            <button class="btn btn-primary">Publish to Instagram</button>
        </form>
<a href="instagram://story-camera?backgroundImage=https://cdn.pixabay.com/photo/2025/10/23/17/29/autumn-9912491_1280.jpg">Insta</a>
        <hr>
        <p class="text-muted">Make sure your Instagram account is a Business/Creator account connected to a Facebook Page. Set FB_ACCESS_TOKEN and IG_BUSINESS_ID in your .env.</p>
    </div>
</body>
</html>
