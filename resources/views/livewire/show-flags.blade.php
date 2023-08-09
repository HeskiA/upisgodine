<div>
    @if($flags['rezultatiDostupni'])
        <div>Rezultati su dostupni!</div>
    @else
        <div>Upisi u tijeku.</div>
        @if($flags['odabirModulaZakljucan'])
            <div>Odabir modula je zaključan</div>
        @else
            <div>Možete mijenjati prioritet modula.</div>
        @endif
        @if($flags['odabirPredmetaZakljucan'])
            <div>Odabir predmeta je zaključan</div>
        @else
            <div>Možete mijenjati prioritet predmeta.</div>
        @endif
    @endif
</div>