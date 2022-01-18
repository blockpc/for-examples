<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{open: 'table'}" @close-form-article.window="open = 'table'">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M6 22h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1H21V4c0-1.103-.897-2-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3zM5 8V5c0-.805.55-.988 1-1h13v12H5V8z"></path><path d="M8 6h9v2H8z"></path>
                        </svg>
                        <span class="text-lg font-semibold" x-show="open == 'table'">Articles List</span>
                        <span class="text-lg font-semibold" x-show="open == 'new'">New Article</span>
                        <span class="text-lg font-semibold" x-show="open == 'edit'">Edit Article</span>
                    </div>
                    <div class="" x-show="open == 'table'">
                        <button type="button" class="p-2 text-white rounded-md bg-blue-800 hover:bg-blue-700 focus:border-blue-900 focus:ring ring-blue-300"
                            x-on:click="open='new', Livewire.emitTo('articles.form-article', 'new')">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                    <div class="" x-show="open != 'table'" x-cloak>
                        <button type="button" class="p-2 text-white rounded-md bg-yellow-800 hover:bg-yellow-700 focus:border-yellow-900 focus:ring ring-yellow-300"
                            x-on:click="open='table', Livewire.emitTo('articles.form-article', 'close')">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M5 11h14v2H5z"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white border-gray-200">
                <div x-show="open == 'table'" id="articles-table-{{auth()->user()->id}}">
                    @livewire('articles.table', [], key('articles-table-'.auth()->user()->id))
                </div>
                <div x-show="open != 'table'" id="articles-form-article-{{auth()->user()->id}}">
                    @livewire('articles.form-article', [], key('articles-form-article-'.auth()->user()->id))
                </div>
            </div>
        </div>
    </div>
</div>
