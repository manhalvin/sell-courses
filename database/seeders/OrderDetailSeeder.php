<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            [
                "id" => 46,
                "name" => "Học Photoshop trọn bộ trong 7 ngày",
                "price" => "799000",
                "quantify" => 1,
                "sub_total" => "799000",
                "thumbnail" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=",
                "user_created" => "Trần Quốc Mạnh",
                "user_updated" => null,
                "user_deleted" => null,
                "order_id" => 46,
                "course_id" => 1,
                "created_at" => Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at" => Carbon::now('Asia/Ho_Chi_Minh'),
                "deleted_at" => null,
            ],
        ]);
    }
}
