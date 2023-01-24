<div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('scan-ok', Mssg => {
            noty(Msg)
        })
        window.livewire.on('scan-notfound', Mssg => {
            noty(Msg, 2)
        })
        window.livewire.on('no-stock', Mssg => {
            noty(Msg, 2)
        })
        window.livewire.on('sale-error', Mssg => {
            noty(Msg)
        })
        window.livewire.on('print-ticket', saleId => {
            window.open("print://" + saleId, '_self').close()
        })
    })
</script>


<!---->
</div>